<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function login() {
        return view('login');
    }
    
    public function regist() {
        return view('register');
    }

    public function ichiran() {
        //インスタンス生成
        $model = new Article();
        $articles = $model->getList();
        return view('ichiran', ['articles' => $articles]);
    }
    public function touroku() {
        //インスタンス生成
        $model = new Article();
        $articles = $model->getList();
        return view('touroku', ['article' => $articles]);
    }
    public function syousai() {
        //インスタンス生成
        $model = new Article();
        $articles = $model->getList();
        return view('syousai', ['articles' => $articles]);
    }
    public function hensyu() {
        //インスタンス生成
        $model = new Article();
        $articles = $model->getList();
        return view('hensyu', ['articles' => $articles]);
    }
}
