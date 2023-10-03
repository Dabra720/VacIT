<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Timeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'date',
        'start',
        'duration',
        'joboffer_id',
        'online',
    ];

    public function company():HasOne
    {
        return $this->HasOne(Company::class);
    }


}
