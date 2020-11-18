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
        return $this->campSchedules()->orderBy('date', 'desc')->get();
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
}
