<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class SaleController extends Controller
{
    public function purchase(Request $request) {
        //リクエストからデータを取得(必要なデータを理解しておく)
        $productId = $request->input('product_id');//送られてきた"pruduct_id"を代入
        $quantity = $request->input('quantity', 1);//購入する数を代入　"quantity"のデータが送られなければ1を代入

        //データベースから商品の商品を検索、取得
        $product = Product::find($productId);//"product_id"が送られてきたらProduct::find($productId)の情報が代入される

        //商品が存在しない、在庫が不足しているときのバリデーション
        if(!$product) {
            return response()->json(['message' => '商品が存在しません'], 404);
        }
        if($quantity <= 0 || $product->stock < $quantity) {
            return response()->json(['message' => '商品が在庫不足です'], 400);
        }

        //在庫を減算
        $product->stock -= $quantity;
        $product->save();

        //Salesテーブルに商品IDと購入日時を記録
        $sale = new Sale([
            'product_id' => $productId,//配列にする
        ]);

        //レスポンスを返す
        return response()->json(['message' => '購入成功']);
    }
}
