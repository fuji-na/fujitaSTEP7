<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    public function getList(){
        //companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();

        return $companies;
    }
}
