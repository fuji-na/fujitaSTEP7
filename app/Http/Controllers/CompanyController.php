<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{

    /*public function ichiran(Request $request) {
        $keyword = $request->input('keyword');
        //インスタンス生成
        $model = new company();
        $companies = $model->getList();
        return view('ichiran', ['companies' => $companies, 'keyword' => $keyword]);
        
    }*/

}
