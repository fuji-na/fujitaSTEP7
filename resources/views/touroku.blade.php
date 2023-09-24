    @extends('layouts.app')
    
    @section('title', '登録画面')

    @section('content')
    
        <div class="center-content">
                <form action="{{ route('registSubmit') }}" method="post" enctype="multipart/form-data">
                    @csrf
            <table class="create">
                <tbody>
                    <tr>
                        <th>商品名</th>
                        <td><input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                            @if($errors->has('product_name'))
                                <p>{{ $errors->first('product_name')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>メーカー名</th>
                        <td>
                            <select id="company_id" name="company_id" value="{{ old('company_id') }}" required>
                                <option>選択してください</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company_id'))
                                <p>{{ $errors->first('company_id')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>価格</th>
                        <td><input type="text" id="price" name="price" value="{{ old('price') }}" required>
                            @if($errors->has('price'))
                            <p>{{ $errors->first('price')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>在庫数</th>
                        <td><input type="text" id="stock" name="stock" value="{{ old('stock') }}" required>
                            @if($errors->has('stock'))
                                <p>{{ $errors->first('stock')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>コメント</th>
                        <td><textarea id="comment" name="comment">{{ old('comment') }}</textarea>
                            @if($errors->has('comment'))
                                <p>{{ $errors->first('comment')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>商品画像</th>
                        <td><input type="file" id="img_path" name="img_path">
                            @if($errors->has('img_path'))
                                <p>{{ $errors->first('img_path')}}</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
                    <button class="create-btn" type="submit">新規登録</button>
                    <button class="return" onclick="location.href='./ichiran'">戻る</button>
                </form>
        </div>
    @endsection
<!--onclick="location.href='./touroku'"-->