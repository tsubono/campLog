<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_OTHER = 3;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $dates = ['camp_start_date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function campSchedules(): HasMany
    {
        return $this->hasMany(CampSchedule::class);
    }

    /**
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(UserLink::class);
    }

    /**
     * アバター画像パス
     *
     * @return string
     */
    public function getDisplayAvatarPathAttribute(): string
    {
        return $this->avatar_path ?? asset('img/default-avatar.png');
    }

    /**
     * 背景画像パス
     *
     * @return string
     */
    public function getDisplayBackgroundPathAttribute(): string
    {
        return $this->background_path ?? asset('img/default-image.png');
    }

    /**
     * パスワードリセットメールを日本語化
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    /**
     * キャンプ予定を取得する
     *
     * @return Collection
     */
    public function getCampSchedulesDescAttribute(): Collection
    {
        return $this->campSchedules()->where('is_public', true)->orderBy('date', 'desc')->get();
    }

    /**
     * キャンプ予定のサマリを取得する
     *
     * @return array
     */
    public function getSummaryAttribute(): array
    {
        $summary = [];
        $campSchedules = $this->campSchedules()->where('is_public', true)->orderBy('date', 'desc')->get();
        $stayCountByMonth = [];

        foreach ($campSchedules as $campSchedule) {
            $year = $campSchedule->date->format('Y');
            $month = $campSchedule->date->format('n');
            if (!isset($summary[$year])) {
                for ($i=1; $i<=12; $i++) {
                    $stayCountByMonth[$i] = 0;
                }
                $summary[$year] = [
                    'stayCount' => 0,
                    'dayCount' => 0,
                    // キャンプ場所数
                    'campPlaceCount' => count($this->campSchedules()
                        ->whereYear('date', $year)
                        ->select('camp_place_id')
                        ->groupBy('camp_place_id')
                        ->get()),
                    'stayCountByMonth' => $stayCountByMonth
                ];
            }

            // 宿泊数
            $summary[$year]['stayCount'] += $campSchedule->number_of_stay;
            $summary[$year]['stayCountByMonth'][$month] += $campSchedule->number_of_stay;
            // デイ数
            if (empty($campSchedule->number_of_stay)) {
                $summary[$year]['dayCount'] += 1;
            }
        }

        return $summary;
    }

    /**
     * 性別テキストを取得する
     *
     * @return string
     */
    public function getGenderTxtAttribute(): string
    {
        switch ($this->gender) {
            case self::GENDER_MALE:
                return '男性';
            case self::GENDER_FEMALE:
                return '女性';
            case self::GENDER_OTHER:
                return 'その他';
            default:
                return '';
        }
    }

    /**
     * キャンプ歴を算出する
     *
     * @return string|null
     * @throws \Exception
     */
    public function getCampHistoryAttribute()
    {
        if (empty($this->camp_start_date)) {
            return null;
        }

        $date = new \DateTime($this->camp_start_date);
        $now = new \DateTime();
        $interval = $now->diff($date);

        if (empty($interval->y) &&  empty($interval->m)) {
            return null;
        }
        if (empty($interval->y)) {
            return "{$interval->m}ヶ月";
        }
        if (empty(($interval->m))) {
            return "{$interval->y}年";
        }

        return "{$interval->y}年{$interval->m}ヶ月";
    }

    /**
     * リンク一覧を取得する
     *
     * @return array
     */
    public function getLinksAttribute(): array
    {
        $links = $this->links()->get()->toArray();

        $links = array_merge($links, [
            [
                'name' => 'Twitter',
                'url' => $this->twitter_url,
                'icon_path' => asset('img/icon_twitter.svg'),
                'is_public' => $this->is_public_twitter_url,
                'sort' => $this->sort_twitter_url,
                'is_static' => true,
            ], [
                'name' => 'Instagram',
                'url' => $this->instagram_url,
                'icon_path' => asset('img/icon_instagram.svg'),
                'is_public' => $this->is_public_instagram_url,
                'sort' => $this->sort_instagram_url,
                'is_static' => true,
            ], [
                'name' => 'Youtube',
                'url' => $this->youtube_url,
                'icon_path' => asset('img/icon_youtube.svg'),
                'is_public' => $this->is_public_youtube_url,
                'sort' => $this->sort_youtube_url,
                'is_static' => true,
            ], [
                'name' => 'Blog',
                'url' => $this->blog_url,
                'icon_path' => asset('img/icon_blog.svg'),
                'is_public' => $this->is_public_blog_url,
                'sort' => $this->sort_blog_url,
                'is_static' => true,
            ], [
                'name' => 'Facebook',
                'url' => $this->facebook_url,
                'icon_path' => asset('img/icon_facebook.svg'),
                'is_public' => $this->is_public_facebook_url,
                'sort' => $this->sort_facebook_url,
                'is_static' => true,
            ]
        ]);


        foreach ($links as $index => &$link) {
            $sort[$index] = $link['sort'];
            $link['name'] = old("links.$index.name", $link['name']);
            $link['url'] = old("links.$index.url", $link['url']);
            $link['icon_path'] = old("links.$index.icon_path", $link['icon_path']);
            $link['is_public'] = old("links.$index.is_public", $link['is_public']);
            $link['sort'] = old("links.$index.sort", $link['sort']);
        }

        array_multisort($sort, SORT_ASC, $links);

        return $links;
    }

    /**
     * 公開中のリンクがあるかどうか
     *
     * @return bool
     */
    public function getIsPublicLinkAttribute(): bool
    {
        $isPublicLink = false;
        foreach ($this->links as $link) {
            if ($link['is_public'] && !empty($link['url'])) {
                $isPublicLink = true;
            }
        }

        return  $isPublicLink;
    }
}
