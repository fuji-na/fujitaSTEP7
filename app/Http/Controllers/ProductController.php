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
        $products = Product::getList();

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

        $companyModel = new Company();
        $companies = $companyModel->getList();
        
        return view('ichiran', compact('products', 'keyword', 'companies'));
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
        $company = Company::find($product->company_id);

        $companyModel = new Company();
        $companies = $companyModel->getList();

        $productModel = new Company();
        $products = $productModel->getList();

        /*
        $productModel = new Product();
        $products = $productModel->getList();

        $companyModel = new Company();
        $companies = $companyModel->getList();
        */

        return view('syousai', ['product' => $product, 'products' => $products, 'company' => $company, 'companies' => $companies]);
    }



    public function touroku() {
        //インスタンス生成
        $companyModel = new Company();
        $companies = $companyModel->getList();

        $productModel = new Company();
        $products = $productModel->getList();
        return view('touroku', ['products' => $products, 'companies' => $companies]);
    }

    //削除
    public function destroy($id) {
        $product = Product::find($id);
        try{
            $product = Product::findOrFail($id);

            $product->delete();

            logger('商品が削除されました。ID: ' . $product->id);

            session()->flash('success', '商品が削除されました。');
            return redirect()->route('ichiran');
        } catch (\Exception $e) {
            logger('商品が見つかりませんでした。エラーメッセージ: ' . $e->getMessage());
            return redirect()->route('ichiran')->with('error', '商品が見つかりませんでした。');
        }
    }

    
    public function registSubmit(ArticleRequest $request) {
        //トランザクション開始
        DB::beginTransaction();

        $model = new Product();

        try {
            //登録処理呼び出し
            $model->registSubmit($request);//insert_dataの処理を追加させる
            DB::commit();
        } catch (\Exception $e) {
            //logger($e->getMessage()); 
            DB::rollback();
            return back();
        }
        //処理が完了したらtourokuにリダイレクト
        return redirect(route('ichiran'));
    }
}
