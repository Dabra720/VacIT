<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function users() : HasMany
    {
        return $this->hasMany(User::class, 'user_joboffer');
    }
}
