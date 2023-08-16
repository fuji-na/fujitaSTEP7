    @extends('layouts.app')

    @section('title', '一覧画面')

    @section('content')
    <link rel="stylesheet" href="app.css">
        <div>
            <form method="GET" action="{{ route('search') }}">
                @csrf
                <input type="text" name="keyword" placeholder="検索キーワード">
                <label>メーカー名</label>
                <select id="company_id" name="company_id">
                    <option value="">選択してください</option>
                @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
                </select>
                <button type="submit" name="keyword" value="{{ $keyword }}" onclick="location.href='./ichiran'">検索</button>
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>商品画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>メーカー名</th>
                            <th><button type="button" onclick="location.href='./touroku'">新規登録</button></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->img_path}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->company_id}}</td>
                            <td><a href="{{ route('syousai', ['id' => $product->id]) }}" >詳細</a></td>
                            <td>
                                <button type="button" id="deleteBtn{{$product->id}}" data-id="{{$product->id}}" onclick="confirmDelete({{$product->id}})">削除</button>
                                <form id="deleteForm{{$product->id}}" method="POST" action="{{ route('delete', ['id' => $product->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
            <script>
                function confirmDelete (id) {
                    if (confirm('削除しますか？')) {
                        document.getElementById('deleteForm' + id).submit();
                    }
                }
            </script>
        </div>
    @endsection
