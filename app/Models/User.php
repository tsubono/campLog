<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
    public function getAvatarPathAttribute(): string
    {
        return $this->avatar_path ?? asset('img/default-avatar.png');
    }

    /**
     * 背景画像パス
     *
     * @return string
     */
    public function getBackgroundPathAttribute(): string
    {
        return $this->background_path ?? asset('img/default-background.png');
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
