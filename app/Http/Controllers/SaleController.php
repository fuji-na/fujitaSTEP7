<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;


class SaleController extends Controller
{
    public function purchase(Request $request) {
        DB::beginTransaction();
            try {

                $sale = new Sale();
                $result = $sale->purchase($request->input('productId'), $request->input('quantity', 1));
                
                return response()->json($result);
            } catch (\Exception $e) {
                $model->purchase($request);

                DB::commit();

                logger($e->getMessage());
                return response()->json(['message' => '購入時にエラーが発生しました'], 500);
            }
        }    
}
