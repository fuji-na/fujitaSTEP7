    @extends('layouts.app')

    @section('title', '詳細画面')

    @section('content')
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>メーカー</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>コメント</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->img_path}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->company_id}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->comment}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <button type="submit" onclick="location.href='{{ route('hensyu', ['id' => $product->id]) }}'">編集</button>
        <button type="submit" onclick="location.href='./ichiran'">戻る</button>
    </div>
    @endsection
