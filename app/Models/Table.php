<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderTable;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_meja','status'];

    public function orderTable()
    {
        return $this->hasOne(OrderTable::class);
    }
}
