@extends('layouts.listLayout')
@section('title', '登録画面')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品登録画面</h2>
        <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()">
        @csrf

            <!-- 商品名登録 -->
            <div class=createtable>
                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="product_name" class="form-control" id="product_name" name="product_name" placeholder="Product_name" value="{{ old('product_name')}}">
                    @if ($errors->has('product_name'))
                    <div class="text-danger">
                            <p>{{ $errors->first('product_name') }}</p>
                    @endif
                </div>

                <!--メーカ名-->
                <div class="form-group">
                <label for="company_id">{{ __('メーカー名') }}<span class="badge badge-danger ml-2"></span></label>
                <select class="form-control" id="company_id" name="company_id">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                </div>

                <!-- 価格登録 -->
                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="price" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price')}}">
                    @if ($errors->has('price'))
                    <div class="text-danger">
                            <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <!-- 在庫数登録 -->
                <div class="form-group">
                    <label for="stock">在庫数登録</label>
                    <input type="stock" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ old('stock')}}">
                    @if ($errors->has('stock'))
                    <div class="text-danger">
                            <p>{{ $errors->first('stock') }}</p>
                    @endif
                </div>

                <!-- コメント -->
                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Comment"></textarea>{{ old('comment') }}</textarea>
                    @if ($errors->has('comment'))
                    <div class="text-danger">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                </div>

                <!-- 画像登録 -->
                <form method="POST" action="/upload" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image">
                <button>アップロード</button>
                </form> 
            </div>

            <!-- 登録ボタン -->
            <div class="create-bottom">
                <div class="mt-5">
                    <a class="btn btn-secondary" href="{{ route('list') }}">
                        キャンセル
                    </a>
                    <button type="submit" class="btn btn-primary">
                        登録する
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- 戻るボタン -->
<div class="createback">
  <input class="btn btn-primary" type="button" onclick="history.back(-1)" value="戻る">
</div>

<!-- 確認表示 -->
<script>
function checkSubmit(){
    if(window.confirm('登録してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
</script>
@endsection
