    @extends('layouts.app')

    @section('title', '編集画面')
    
    @section('content')
    <div class="center-content">
        <form action="{{ route('updateProduct', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="edit">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><output class="edit-box" type="text">{{ $product->id }}</output></td>
                </tr>
                <tr>
                    <th>商品名</th>
                    <td><input class="edit-box" type="text" id="product_name" name="product_name" value="{{ $product->product_name }}" required></td>
                </tr>
                <tr>
                    <th>メーカー名</th>
                    <td>
                        <select class="edit-box" id="company_id" name="company_id" required>
                            @foreach($companies as $company)
                            <option value="{{$company->id}}" @if($company->id === $product->company_id) selected @endif>{{$company->company_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td><input class="edit-box" type="text" id="price" name="price" value="{{ $product->price }}" required></td>
                </tr>
                <tr>
                    <th>在庫数</th>
                    <td><input class="edit-box" type="text" id="stock" name="stock" value="{{ $product->stock }}" required></td>
                </tr>
                <tr>
                    <th>コメント</th>
                    <td><textarea class="edit-box" id="comment" name="comment">{{ $product->comment }}</textarea></td>
                </tr>
                <tr>
                    <th>商品画像</th>
                    <td><input class="edit-box" type="file" id="img_path" name="img_path">
                        <img class="image" src="{{ asset('storage/'.$product->img_path) }}">
                    </td>
                </tr>
            </tbody>
        </table>
            <button class="update-btn" type="submit" onclick="location.href='./hensyu'">更新</button>
            <button class="return" type="submit" onclick="location.href='./syousai'">戻る</button>
        </form>
    </div>
    @endsection
