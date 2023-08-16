<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    public function touroku() {
        //インスタンス生成
        $model = new company();
        $companies = $model->getList();
        return view('touroku', ['companies' => $companies]);
    }

    public function registSubmit(ArticleRequest $request) {
        $model = new Product();
        //トランザクション開始
        DB::beginTransaction();

        try {
            //登録処理呼び出し
            $model->registSubmit($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        //処理が完了したらtourokuにリダイレクト
        return redirect(route('ichiran'));
    }

    /*public function ichiran(Request $request) {
        $keyword = $request->input('keyword');
        //インスタンス生成
        $model = new company();
        $companies = $model->getList();
        return view('ichiran', ['companies' => $companies, 'keyword' => $keyword]);
        
    }*/

}
