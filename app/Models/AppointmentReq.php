<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentReq extends Model
{
    use HasFactory;
    protected $table = 'appointment_reqs';
    protected $fillable = ['applicant_id', 'description', 'appointment_date', 'status'];
}
