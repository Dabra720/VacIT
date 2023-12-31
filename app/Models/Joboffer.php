<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Joboffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'description',
        'level',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'joboffer_user', 'joboffer_id', 'user_id')
                    ->withPivot('invited')
                    ->withTimestamps();
    }

    public function invited() : BelongsToMany
    {
        return $this->belongsToMany(User::class)
                ->wherePivot('invited', 1);
    }

    public function timeslots() : HasMany
    {
        return $this->hasMany(Timeslot::class);
    }
}
