<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the Role associated with the user.
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    /**
     * Get the Company associated with the user.
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Get the UserProfile associated with the user.
     */
    // public function userprofile(): HasOne
    // {
    //     return $this->hasOne(UserProfile::class);
    // }

    public function joboffers() : BelongsToMany
    {
        return $this->belongsToMany(Joboffer::class, 'joboffer_user')->withPivot('invited');
    }

    public function timeslots() : HasMany
    {
        return $this->hasMany(Timeslot::class);
    }
}
