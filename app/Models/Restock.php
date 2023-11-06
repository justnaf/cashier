<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Restock extends Model
{
    use HasFactory;

    protected $fillable = ['products_id', 'stock', 'price'];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
