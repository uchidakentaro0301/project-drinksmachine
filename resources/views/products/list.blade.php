@extends('layouts.ajaxLayout')
@section('title','商品一覧')
@section('content')
<div class = "row">
  <div class = "col-md-10 col-md-offset-2">
    <h2>商品一覧画面</h2>

    <!-- エラーがある場合に表示される -->
    @if (session ('err_msg')) 
    <p class = "text-danger">{{ session ('err_msg') }}</p>
    @endif

  <div class = "container">
    <div class ="row">
        <div class ="col">
          <div class ="nedan">
          <span>値段：</span>
          </div>
          <div class = "pop">
           <label for ="upperPriceLimit">上限</lavel>
          </div>
          <div class = "kako">
            <input id ="upperPriceLimit" type="number" name="upperPriceLimit" style="width:100px" min="0" max ="9999" maxlength="4">
            <span>-</span>
          </div>
          <div class = kagen>
           <label for="lowPriceLimit">下限</lavel>
           <input id ="lowerPriceLimit" type ="number" name="lowerPriceLimit" style="width:100px" min="0" max="9999">
          <br>
        </div>

        <div class = all>
          <span>在庫：</span>
          <lavel for="upperStockLimit">上限</lavel>
          <input id="upperStockLimit" type="number" name="upperStockLimit" style="width:100px" min="0" max="9999">
          <span>-</span>
          <label for="lowerStockLimit">下限</lavel>
          <input id="lowerStockLimit" type="number" name="lowerStockLimit" style="width:100px" min="0" max="9999">
        </div>
    </div>

<!-- 昇順ボタン -->
<div class = "turn-button">
  <button type="button" class="asc">昇順</button>

  <!-- 降順ボタン -->
  <button type="button" class= "DESC">降順</button>
</div>

<!-- 検索フォーム -->
<div class = "searchall">
    <div class="search">
        <p>商品名検索</p>
        <div>
            <div class="post-search-form col-md-6">
                <!-- <form class="form-inline" action="{{ route('search') }}" method="Post"> -->
                   @csrf
                   <div class="form-group">
                       <input type="key" name="keyword" class="form-control" placeholder="キーワードを入力" id = "keyword">
                   </div>
                    <div class="good1">
                       <!-- <a class="ajaxbnt" href ="#">検索</a> -->
                       <button id = "ajaxbnt">検索</button>
                    </div>
              <!-- </form> -->
            </div>
        </div>
    </div>
  </div>

<!-- カテゴリープルダウン -->
  <div class="pull">
      <label for="company_id">{{ __('メーカー名') }}<span class="badge badge-danger ml-2"></span></label>
          <select class="form-control" id="company_id" name="company_id">
             @foreach ($companies as $company)
                  <option value="{{ $company->id }}">{{ $company->company_name }}</option>
             @endforeach
          </select>
  </div>
</div>
        </div>
      </div>
    </div>
    <table class="table table-striped home">
      <thead>
        <tr>
        <th><button data-pressed="id" data-sort="asc" type="button" class="btn sortButton">ID</button></th>
          <th>商品画像</th>
          <th><button data-pressed="product_name" data-sort="asc" type="button" class="btn sortButton">商品名</button></th>
          <th><button data-pressed="price" data-sort="asc" type="button" class="btn sortButton">価格</button></th>
          <th><button data-pressed="stock" data-sort="asc" type="button" class="btn sortButton">在庫数</button></th>
          <th><button data-pressed="company_name" data-sort="asc" type="button" class="btn sortButton">メーカー名</button></th>
          <th></th>
          <th></th>
        </tr>
    </thead>
      <tbody id="productList">
      @foreach($products as $product)
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
    </thead>
    <br>
    <!-- サーバーに送信されるデータを格納するために使用 -->
    <input id="storedWord" name="storedWord" type="hidden">
    <input id="storedCompany" name="storedCompany" type="hidden">
    <input id="storedUpperPriceLimit" name="storedUpperPriceLimit" type="hidden">
    <input id="storedLowerPriceLimit" name="storedLowerPriceLimit" type="hidden">
    <input id="storedUpperStockLimit" name="storedUpperStockLimit" type="hidden">
    <input id="storedLowerStockLimit" name="storedLowerStockLimit" type="hidden">
    <input id="storedPressedButton" name="storedPressedButton" type="hidden">
    <input id="storedSortToggle" name="storedSortToggle" type="hidden">
  </div>
</div>
@endsection