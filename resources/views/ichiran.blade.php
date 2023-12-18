    @extends('layouts.app')

    @section('title', '一覧画面')

    @section('content')
    <link rel="stylesheet" href="app.css">
        <div id="product-list" class="center-content">
            <form id="search" method="GET" action="{{ route('search') }}">
                @csrf
                <input type="text" name="keyword" placeholder="検索キーワード">
                <label>メーカー名</label>
                <select id="company_id" name="company_id">
                    <option value="">選択してください</option>
                @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
                </select>
                <input type="number" name="min_price" placeholder="最小価格">
                <input type="number" name="max_price" placeholder="最大価格">
                <input type="number" name="min_stock" placeholder="最小在庫">
                <input type="number" name="max_stock" placeholder="最大在庫">
                <button class="search" type="submit">検索</button>
            </form>
                <table class="all">
                    <thead>
                        <tr>
                            <th>@sortablelink('id', 'ID')</th>
                            <th>@sortablelink('img_path', '商品画像')</th>
                            <th>@sortablelink('product_name', '商品名')</th>
                            <th>@sortablelink('price', '価格')</th>
                            <th>@sortablelink('stock', '在庫数')</th>
                            <th>@sortablelink('company_name', 'メーカー名')</th>
                            <th><button type="button" onclick="location.href='./touroku'">新規登録</button></th>
                            <th><button class="list" type="submit" onclick="location.href='{{ route('ichiran') }}'">一覧</button></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img class="image" src="{{ asset('storage/'.$product->img_path) }}"></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->company->company_name}}</td>
                            <td><a href="{{ route('syousai', ['id' => $product->id]) }}" >詳細</a></td>
                            <td>
                                <form id="deleteForm{{$product->id}}" method="POST" action="{{ route('post.destroy', ['id' => $product->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete" type="submit" id="deleteBtn{{$product->id}}" data-id="{{$product->id}}" onclick="return confirm('本当に削除しますか？');">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
        </div>
    @endsection
