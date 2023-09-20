<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'date_of_birth',
        'phone',
        'address',
        'postcode',
        'city',
        'image'
    ];

    public function user() : HasOne 
    {
        return $this->hasOne(User::class);
    }
}
