<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'cost',
        'price',
        'pic_path',
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function restock()
    {
        return $this->hasMany(Restock::class);
    }
}
