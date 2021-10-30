<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
