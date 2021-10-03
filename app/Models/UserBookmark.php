<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBookmark extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * データ取得時に付与する情報
     *
     * @var array
     */
    protected $appends = [
        'place',
    ];


    /**
     * @return BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(CampPlace::class, 'camp_place_id');
    }

    /**
     * @return Model|BelongsTo|object|null
     */
    public function getPlaceAttribute()
    {
        return $this->place()->first();
    }
}
