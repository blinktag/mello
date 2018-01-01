<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function boards(): HasMany
    {
        return $this->hasMany(Board::class);
    }

    /**
     * Generate gravatar URL for the user
     *
     * @return string
     */
    public function getGravatarUrl(): string
    {
        $hash = md5(strtolower($this->email));
        return "https://www.gravatar.com/avatar/{$hash}";
    }
}
