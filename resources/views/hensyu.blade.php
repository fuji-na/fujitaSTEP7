    @extends('layouts.app')

    @section('title', '編集画面')
    
    @section('content')
    <div>
        <form action="{{ route('update', ['id' => $product->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <label>ID</label>
                <output></output>
            </div>
            <div>
                <label for="product_name">I商品名</label>
                <input type="text" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
            </div>
            <div>
                <label for="company_id">メーカー名</label>
                <select id="company_id" name="company_id" required>
                <option>選択してください</option>
                @foreach($companies as $company)
                    <option value="{{$company->id}}" @if($company->id === $company->id) selected @endif>{{$company->id}}</option>
                @endforeach
                </select>
            </div>
            <div>
                <label for="price">価格</label>
                <input type="text" id="price" name="price" value="{{ $product->price }}" required>
            </div>
            <div>
                <label for="stock">在庫数</label>
                <input type="text" id="stock" name="stock" value="{{ $product->stock }}" required>
            </div>
            <div>
                <label for="comment">コメント</label>
                <textarea id="comment" name="comment">{{ $product->comment }}</textarea>
            </div>
            <div>
                <label for="img_path">商品画像</label>
                <input type="file" id="img_path" name="img_path">
            </div>
            <button type="submit" onclick="location.href='./hensyu'">更新</button>
            <button type="submit" onclick="location.href='./syousai'">戻る</button>
        </form>
    </div>
    @endsection
