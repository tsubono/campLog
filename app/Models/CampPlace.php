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
     * @return HasMany
     */
    public function campSchedules(): HasMany
    {
        return $this->hasMany(CampSchedule::class);
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
}
