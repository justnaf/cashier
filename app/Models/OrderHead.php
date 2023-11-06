<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer',
        'seller',
    ];

    public function orderdetail() : HasMany {
        return $this->hasMany(OrderDetail::class,'order_heads_id','id');
    }

    static function AddHeadOrder($seller,$buyer){
        $data = OrderHead::create([
            'buyer' => $buyer,
            'seller'=> $seller
        ]);

        return $data->id;
    }
}
