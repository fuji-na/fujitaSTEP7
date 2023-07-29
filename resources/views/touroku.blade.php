    @extends('layouts.app')
    
    @section('title', '登録画面')

    @section('content')
    
        <div>
            <form action="{{ route('registSubmit') }}" method="post">
                @csrf
                <div>
                    <label for="product_name">商品名</label>
                    <input type="text" id="product_name" name="product_name" required>
                </div>
                <div>
                    <label for="company_id">メーカー名</label>
                    <select id="company_id" name="company_id" required>
                        <option>選択してください</option>
                    @foreach($products as $product)
                        <option>{{$product->company_id}}</option>
                    @endforeach
                    </select>
                </div>
                <div>
                    <label for="price">価格</label>
                    <input type="text" id="price" name="price" required>
                </div>
                <div>
                    <label for="stock">在庫数</label>
                    <input type="text" id="stock" required>
                </div>
                <div>
                    <label for="comment">コメント</label>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <div>
                    <label for="img_path">商品画像</label>
                    <input type="file" id="img_path" name="img_path">
                </div>
                <button type="submit">新規登録</button>
                <button onclick="location.href='./ichiran'">戻る</button>
            </form>
        </div>
    @endsection
<!--onclick="location.href='./touroku'"-->