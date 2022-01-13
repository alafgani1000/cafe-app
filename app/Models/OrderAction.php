<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderAction extends Model
{
    use HasFactory;
    protected $fillable = ["order_id","action","data","user_id","table_name"];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
