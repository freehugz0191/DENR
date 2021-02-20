<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $table = 'applicants';
    protected $fillable = ['fname','lname','contact','email','address', 'gender', 'date_birth'];

    
}
