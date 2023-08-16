<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function ichiran(Request $request){
        $keyword = $request->input('keyword');
        //インスタンス生成
        $productModel = new Product();
        $products = $productModel->getList();

        $companyModel = new Company();
        $companies = $companyModel->getList();

        return view('ichiran', ['products' => $products, 'companies' => $companies, 'keyword' => $keyword]);
    }

    //検索
    public function search(Request $request){
        $keyword = $request->input('keyword');
        //インスタンス生成
        $model = new Product();
        $products = Product::searchByKeyword($keyword)->get();
        
        return view('ichiran', compact('products', 'keyword'));
    }

    public function hensyu($id) {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('ichiran')->with('error', 'Product not found.');
        }
        //インスタンス生成
        $model = new Product();
        $products = $model->getList();

        $companyModel = new Company();
        $companies = $companyModel->getList();

        return view('hensyu', ['product' => $product, 'products' => $products, 'companies' => $companies]);
    }

    //更新
    public function update(Request $request, $id) {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('ichiran')->with('error', 'Product not found.');
        }

        $product->updateProduct($request);

        return redirect()->route('ichiran')->with('success', 'Product updated successfully.');
    }

    public function syousai($id) {
        //インスタンス生成
        $product = Product::find($id);

        return view('syousai', ['product' => $product]);
    }

    public function touroku() {
        //インスタンス生成
        $model = new Product();
        $companies = $model->getList();
        return view('touroku', ['companies' => $companies]);
    }

    //削除
    public function deleteProduct($id) {
        $product = Product::find($id);
        if(!product) {
            //returnでメッセージを返す
        }
        $product->delete();
        return redirect()->route('ichiran');
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
}
