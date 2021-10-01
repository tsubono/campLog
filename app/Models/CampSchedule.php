<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampSchedule extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $dates = ['date'];

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(CampScheduleImage::class)->orderBy('sort');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(CampPlace::class, 'camp_place_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    public function getCampPlaceNameAttribute()
    {
        $place = $this->place()->first();
        return !empty($place) ? $place->name : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    public function getNumberOfStayTextAttribute()
    {
       return !empty($this->number_of_stay) ? "{$this->number_of_stay}泊" : 'デイ';
    }

    /**
     * アイキャッチ画像
     *
     * @return string
     */
    public function getEyeCatchImagePathAttribute(): string
    {
        return !empty($this->images[0]) ? str_replace("camp-schedule/", "camp-schedule/resized-", $this->images[0]->image_path) : asset('img/default-image.png');
    }

    /**
     * @return array
     */
    public function getImagePathsAttribute(): array
    {
        $res = [];
        foreach ($this->images as $image) {
            $res[] = $image->image_path;
        }
        return $res;
    }

    /**
     * 文字列のリンク部分に<a>タグを埋め込む
     *
     * @return string
     */
    public function getNoteWithLinkAttribute(): string
    {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" target="_blank" rel="nofollow">$1</a>';
        return preg_replace($pattern, $replace, $this->note);
    }

    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    public function getReviewImageAttribute()
    {
        $image = $this->images()->orderBy('created_at')->first();

        return !empty($image) ? $image->image_path : asset('img/default-image.png');
    }
}
