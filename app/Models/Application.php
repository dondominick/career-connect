<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['listing_id', 'resume', 'companyID', 'applicant_id', 'employer_id'];



    protected $table = "job_applications";


    public function listing()
    {
        return $this->belongsTo(listing::class);
    }
}
