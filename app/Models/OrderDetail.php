<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_heads_id',
        'produk',
        'qty',
        'subtotal',
    ];

    public function orderheads() : BelongsTo {
        return $this->belongsTo(OrderHead::class);
    }
}
