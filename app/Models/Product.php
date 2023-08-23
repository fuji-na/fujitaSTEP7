<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    
    public function getList(){
        //productsテーブルからデータを取得
        $products = DB::table('products')->get();

        return $products;
    }

    //検索
    protected $fillable = ['product_name','company_id', 'price', 'stock', 'comment', 'img_path'];

    public function scopeSearchBykeyword($query, $keyword){
        if(!empty($keyword)){
            return $query->where('product_name', 'LIKE', "%{keyword}%")
                         ->orWhere('company_id', 'LIKE', "%{keyword}%");
        }
        return $query;
    }

    //編集
    public function updateProduct($data) {
        $this->update([
            'product_name' => $data['product_name'],
            'company_id' => $data['company_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $data['img_path'],
        ]);
    }
    //削除
    public function customDeleteMethod() {
        $this->delete();
    }

    public function registSubmit($data) {
        //登録処理
        DB::table('products')->insert([
            'product_name' => $data['product_name'],
            'company_id' => $data['company_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $data['img_path'],
        ]);
    }
}
