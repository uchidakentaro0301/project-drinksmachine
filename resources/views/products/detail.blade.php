@extends('layouts.listLayout')
@section('title', '詳細画面')

@section('content')
<h3>詳細確認</h3>
<table class="table table-striped">
  <thead>
    <tr>
    <th>ID</th>
    <th>商品画像</th>
    <th>商品名</th>
    <th>価格</th>
    <th>在庫数</th>
    <th>メーカー名</th>
    <th>コメント</th>
    <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td>{{ $product->id}}</td>
    <td>{{ $product->img_path}}</td>
    <td>{{ $product->product_name}}</td>
    <td>{{ $product->price}}</td>
    <td>{{ $product->stock}}</td>
    <td>{{ $product->company_name}}</td>
    <td>{{ $product->comment}}</td>
    <td><a href="{{ route('edit', $product->id) }}"class="btn btn-primary btn-sm">編集画面</a></td>
    </tr>
  </tbody>
</table>
  <!-- 戻るボタン -->
  <div class="detailback">
    <input class="btn btn-primary" type="button" onclick="history.back(-1)" value="戻る">
  </div>
</body>
  
@endsection 
