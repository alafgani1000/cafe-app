<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','menu_id','menu','qty','price'];

    public function order()
    {
        return $this->belongsTo(User::class);
    }
}
