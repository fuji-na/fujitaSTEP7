<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'products';
    //productsテーブルからデータを取得
    public static function getList() {
        return self::with('company');
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    //検索
    protected $fillable = ['product_name','company_name', 'company_id', 'price', 'stock', 'comment', 'img_path'];
    public $sortable = ['id', 'product_name', 'price', 'stock', 'company_name'];

    public function scopeSearchBykeyword($query, $keyword, $min_price, $max_price, $min_stock, $max_stock){
        if(!empty($keyword)){

            return $query->where('product_name', 'LIKE', "%$keyword%")
                         ->orWhereHas('company', function ($query) use ($keyword) {
                            $query->where('company_name', 'LIKE', "%$keyword%");
                         })
                         ->orWhere('comment', 'LIKE', "%$keyword%")
                         ->orWhere('stock', 'LIKE', "%$keyword%")
                         ->orWhere('price', 'LIKE', "%$keyword%");
        }

        $query->with('company');
    }

    //編集
    public function updateProduct($data, $img_path) {
        $this->update([
            'product_name' => $data['product_name'],
            'company_id' => $data['company_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $img_path,
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
