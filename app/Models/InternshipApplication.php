<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = ['internship_id', 'resume', 'companyID', 'applicant_id', 'employer_id'];


    protected $table = "internships_applications";
}
