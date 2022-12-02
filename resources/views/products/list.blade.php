@extends('layouts.listLayout')
@section('title', '商品情報画面')

@section('content')
<!-- 検索フォーム -->
<div class="search">
    <p>商品名検索</p>
    <div>
        <div class="post-search-form col-md-6">
            <form class="form-inline" action="{{ route('search') }}" method="Post">
                @csrf
                <div class="form-group">
                    <input type="key" name="keyword" class="form-control" placeholder="キーワードを入力">
                </div>
                <div class="good1">
                    <input type="submit" value="検索" class="btn btn-info">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- カテゴリープルダウン -->
<div class="form-search">
    <label for="company_id">{{ __('メーカー名') }}<span class="badge badge-danger ml-2"></span></label>
        <select class="form-control" id="company_id" name="company_id">
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select>
</div> 

<!-- カラム -->
<div class="listtable">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        @foreach($products as $product)
        <tbody>
        <tr>
            <td>{{ $product->id}}</td>
            <td>{{ $product->img_path}}</td>
            <td>{{ $product->product_name}}</td>
            <td>{{ $product->price}}</td>
            <td>{{ $product->stock}}</td>
            <td>{{ $product->company_name}}</td>

            <!-- 詳細ボタン -->
            <td><a href="{{ route('detail', $product->id) }}"class="btn btn-primary btn-sm">詳細</a></td>

            <!-- 削除ボタン -->
            <td>
                <form  method="POST" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()">
                    @csrf
                    <input type="submit" class="btn btn-danger btn-dell" value="削除">
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

<!-- JavaScriptバリデーション -->
<script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？?')){
        return true;
    } else {
        return false;
    }
}
</script>