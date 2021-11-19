<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Status;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name','status','price','price_initial','discount','image','image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status');
    }

    public function scopeMakanan($query)
    {
        return $query->where('category_id',4);
    }
}
