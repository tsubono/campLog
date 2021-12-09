<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampPlace extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $appends = [
        'camp_schedule_reviews',
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
    public function userBookmarks(): HasMany
    {
        return $this->hasMany(UserBookmark::class);
    }

    /**
     * @return CampPlace|\Illuminate\Database\Eloquent\Collection
     */
    public function getCampSchedulesHasReviewAttribute(): Collection
    {
        return $this->campSchedules()
            ->where('is_public', true)
            ->whereNotNull('review')
            ->get();
    }

    /**
     * @return array
     */
    public function getCampScheduleReviewsAttribute()
    {
        return $this->campSchedules()
            ->where('is_public', true)
            ->whereNotNull('review')
            ->get()
            ->append(['review_image'])
            ->makeHidden(['camp_place', 'user_info', 'schedule_images'])
            ->toArray();
    }
}
