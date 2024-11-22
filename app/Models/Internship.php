<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'location',
        'salary',
        'education',
        'description',
        'requirements',
        'employer_id',
        'company',
        'email',
        'companyID',
        'age',
        'duration',
        'hours',
        'type',
        'arrangement',
        'experience',
        'skills',

    ];
}
