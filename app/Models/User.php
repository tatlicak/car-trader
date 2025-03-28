<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'google_id',
        'facebook_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*     public function favouriteCars(): BelongsToMany
{
    return $this->belongsToMany(Car::class, 'favourite_cars', 'user_id', 'car_id');
} */


    /*  If your pivot table has created_at and updated_at columns and you want them to be automatically managed by Eloquent. */

    public function favouriteCars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'favourite_cars')->withTimestamps();
    }



    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
