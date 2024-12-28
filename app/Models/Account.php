<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ["email","fullname","password","otp","expireotp","status"];
}
