<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampPlace extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = ['id'];
}
