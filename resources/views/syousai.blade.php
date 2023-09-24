    @extends('layouts.app')

    @section('title', '詳細画面')

    @section('content')
    <div class="center-content">
        <table class="detail">
            <thead>
                <tr>
                    <th>ID</th>
                    <td>{{$product->id}}</td>
                </tr>
                <tr>
                    <th>商品画像</th>
                    <td>{{$product->img_path}}</td>
                </tr>
                <tr>
                    <th>商品名</th>
                    <td>{{$product->product_name}}</td>
                </tr>
                <tr>
                    <th>メーカー</th>
                    <td>{{$company->company_name}}</td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td>{{$product->price}}</td>
                </tr>
                <tr>
                    <th>在庫数</th>
                    <td>{{$product->stock}}</td>
                </tr>
                <tr>
                    <th>コメント</th>
                    <td>{{$product->comment}}</td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="center-content">
        <button class="edit-btn" type="submit" onclick="location.href='{{ route('hensyu', ['id' => $product->id]) }}'">編集</button>
        <button class="return" type="submit" onclick="location.href='{{ route('ichiran') }}'">戻る</button>
    </div>
    @endsection
