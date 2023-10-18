<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    //productsテーブルからデータを取得
    public static function getList() {
        return self::with('company');
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    //検索
    protected $fillable = ['product_name','company_name', 'price', 'stock', 'comment', 'img_path'];

    public function scopeSearchBykeyword($query, $keyword){
        if(!empty($keyword)){
            return $query->where('product_name', 'LIKE', "%$keyword%")
                         ->orWhereHas('company', function($query) use ($keyword) {
                            $query->where('company_name', 'LIKE', "%$keyword%");
                         })
                         ->orWhere('comment', 'LIKE', "%$keyword%")
                         ->orWhere('stock', 'LIKE', "%$keyword%")
                         ->orWhere('price', 'LIKE', "%$keyword%")
                        ->with('company');
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

    public function registSubmit($data, $img_path) {
        //登録処理
        DB::table('products')->insert([
            'product_name' => $data->input('product_name'),
            'company_id' => $data->input('company_id'),
            'price' => $data->input('price'),
            'stock' => $data->input('stock'),
            'comment' => $data->input('comment'),
            'img_path' => $img_path,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
