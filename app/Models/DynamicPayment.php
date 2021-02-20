<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicPayment extends Model
{
    use HasFactory;

    protected $table = 'dynamic_payments';
}
