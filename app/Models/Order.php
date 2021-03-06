<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\OrderTable;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\OrderAction;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id_reservation','total_price','description','status','tnumber'];

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
        return $this->belongsTo(OrderStatus::class,'status','id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function orderActions()
    {
        return $this->hasMany(OrderAction::class);
    }
}
