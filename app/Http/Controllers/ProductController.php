<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function ichiran(Request $request){

        
        $products = Product::sortable(['id' => 'desc'])->paginate(3);

        $companyModel = new Company();
        $companies = $companyModel->getList();

        return view('ichiran', ['products' => $products, 'companies' => $companies]);
    }



    //検索
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id'); 
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $min_stock = $request->input('min_stock');
        $max_stock = $request->input('max_stock');
        
        $query = Product::query();

        if (!empty($keyword)) {
            $query->searchByKeyword($keyword,);
        }
    
        if (!empty($company_id)) {
            $query->where('company_id', $company_id);
        }

        if(!empty($min_price)) {
            $query->where('price', '<=', $min_price);
        }
        if(!empty($max_price)) {
            $query->where('price', '>=', $max_price);
        }
        if(!empty($min_stock)) {
            $query->where('stock', '<=', $min_stock);
        }
        if(!empty($max_stock)) {
            $query->where('stock', '>=', $max_stock);
        }

    
        //インスタンス生成
        $model = new Product();

        $products = $query->paginate(3);

        $companyModel = new Company();
        $companies = $companyModel->getList();
        //dd($min_price);

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
    public function updateProduct(Request $request, $id) {
        DB::beginTransaction();

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('ichiran')->with('error', 'Product not found.');
        }
        
        try {
            
            if($request->hasFile('img_path')) {
                $filename = $request->file('img_path')->getClientOriginalName();
                $request->file('img_path')->storeAs('public', $filename);
                $img_path = $filename;
            } else {
                $img_path = $product->img_path;
            }
            //更新処理呼び出し
            $product->updateProduct($request, $img_path);

    
            DB::commit();

            logger('商品が更新されました。');

            session()->flash('success', '商品が更新されました。');

        } catch (\Exception $e) {
            logger($e->getMessage()); 
            DB::rollback();
            return back();
        }

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


        return view('syousai', ['product' => $product, 'products' => $products, 'company' => $company, 'companies' => $companies]);
    }


    public function touroku(Request $request) {
        //インスタンス生成
        $companyModel = new Company();
        $companies = $companyModel->getList();

        $productModel = new Company();
        $products = $productModel->getList();

        return view('touroku', ['products' => $products, 'companies' => $companies]);
    }

    //削除
    public function destroy($id) {
        DB::beginTransaction();
        $product = Product::find($id);

        try{
            $product = Product::findOrFail($id);

            $product->delete();

            session()->flash('success', '商品が削除されました。');

            DB::commit();

            //return response()->json(['message' => '削除成功']);


        } catch (\Exception $e) {
            logger('商品が削除されました。ID: ' . $product->id . $e->getMessage());
            DB::rollback();
            return back();
        }
            //return response()->json(['error' => '削除失敗'], 500);
            return redirect()->route('ichiran')->with('error', '商品が見つかりませんでした。');
    }

    
    public function registSubmit(Request $request) {

        //トランザクション開始
        DB::beginTransaction();

        $model = new Product();

        try {
            
            if($request->hasFile('img_path')) {
                $filename = $request->file('img_path')->getClientOriginalName();
                $request->file('img_path')->storeAs('public', $filename);
                $img_path = $filename;
            } else {
                $img_path = null;
            }

            //登録処理呼び出し
            $model->registSubmit($request, $img_path);

    
            DB::commit();

            logger('商品が登録されました。');

            session()->flash('success', '商品が登録されました。');

        } catch (\Exception $e) {
            logger($e->getMessage()); 
            DB::rollback();
            return back();
        }


        //dd($request);
        //処理が完了したらtourokuにリダイレクト
        return redirect(route('ichiran'));
    }
}
