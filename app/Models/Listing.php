<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'position',
        'location',
        'max_salary',
        'min_salary',

        'education',
        'description',
        'requirements',
        'employer_id',
        'company',
        'email',
        'companyID',
        'min_age',
        'max_age',
        'duration',
        'hours',
        'type',
        'arrangement',
        'experience',
        'skills',

    ];


    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
