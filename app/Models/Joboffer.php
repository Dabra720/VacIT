<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
