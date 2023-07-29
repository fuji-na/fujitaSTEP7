<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestUserController extends Controller
{
    public function showList(){
        //インスタンス生成
        $model = new TestUser();
        $TestUser = $model->getList();

        return view('login', ['TestUsers' => $TestUser]);
    }
}
