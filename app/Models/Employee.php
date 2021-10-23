<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','name','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat','status','nik','email'];

}
