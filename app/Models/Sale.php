<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    //protected $table = 'sale';
    protected $fillable = ['id','product_id','quantity'];

    /*public static function getList() {
        return self::with('product');
    }*/


    public function purchase($productId, $quantity) {
        $product = Product::find($productId);

        if (!$product) {
            return ['message' => '商品が存在しません'];
        }

        if ($product->stock < $quantity) {
            return ['message' => '商品が在庫不足です'];
        }

        // 在庫を減算
        $product->stock -= $quantity;
        $product->save();

        Sale::create([
            'product_id' => $productId,
            'quantity' => $quantity
        ]);

        return ['message' => '購入成功'];
    }    
}
