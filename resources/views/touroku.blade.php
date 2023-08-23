    @extends('layouts.app')
    
    @section('title', '登録画面')

    @section('content')
    
        <div>
            <form action="{{ route('registSubmit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="product_name">商品名</label>
                    <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name')}}</p>
                    @endif
                </div>
                <div>
                    <label for="company_id">メーカー名</label>
                    <select id="company_id" name="company_id" value="{{ old('company_id') }}" required>
                        <option>選択してください</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                    </select>
                    @if($errors->has('company_id'))
                        <p>{{ $errors->first('company_id')}}</p>
                    @endif

                </div>
                <div>
                    <label for="price">価格</label>
                    <input type="text" id="price" name="price" value="{{ old('price') }}" required>
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price')}}</p>
                    @endif

                </div>
                <div>
                    <label for="stock">在庫数</label>
                    <input type="text" id="stock" name="stock" value="{{ old('stock') }}" required>
                    @if($errors->has('stock'))
                        <p>{{ $errors->first('stock')}}</p>
                    @endif

                </div>
                <div>
                    <label for="comment">コメント</label>
                    <textarea id="comment" name="comment">{{ old('comment') }}</textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('comment')}}</p>
                    @endif

                </div>
                <div>
                    <label for="img_path">商品画像</label>
                    <input type="file" id="img_path" name="img_path">
                    @if($errors->has('img_path'))
                        <p>{{ $errors->first('img_path')}}</p>
                    @endif

                </div>
                <button type="submit">新規登録</button>
                <button onclick="location.href='./ichiran'">戻る</button>
            </form>
        </div>
    @endsection
<!--onclick="location.href='./touroku'"-->