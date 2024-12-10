<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        "applicant_id",
        "name",
        "age",
        'gender',
        'email',
        'contact_no',
        'address',
        'education',
        'degree',
        'skills',
        'work',
        'educational_background',
        'reference',
        'undergrad'
    ];
}
