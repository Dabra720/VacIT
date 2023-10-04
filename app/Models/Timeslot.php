<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function joboffer():BelongsTo
    {
        return $this->belongsTo(Joboffer::class);
    }
}
