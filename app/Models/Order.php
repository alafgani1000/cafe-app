<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\OrderTable;
use App\Models\OrderStatus;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id_reservation','total_price','description'];

    public function detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function table()
    {
        return $this->hasMany(OrderTable::class);
    }

    public function statusMaster()
    {
        return $this->hasOne(OrderStatus::class,'id');
    }
}
