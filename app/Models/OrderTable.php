<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderTable extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','table_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
