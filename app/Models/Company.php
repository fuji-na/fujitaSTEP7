<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;
    
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = ['company_name'];
    public function getList(){
        //companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();

        return $companies;
    }
}
