<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAction extends Model
{
    use HasFactory;
    protected $fillable = ["payment_id","data","action","user_id"];
}
