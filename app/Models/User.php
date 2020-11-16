<?php

namespace App\Models;

use App\Notifications\PasswordReset;
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
}
