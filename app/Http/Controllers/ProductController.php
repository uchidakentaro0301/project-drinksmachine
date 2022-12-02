<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

use\App\Http\Requests\CreateRequest;

class ProductController extends Controller
{
// 登録画面
public function showRegistForm() {
    $product = showList::all();
    return view ('list', compact('product'));
}  

//商品一覧画面表示
public function showList() {
    $model = new Product();
    $companies  = new Company();
    $allCompany = $companies->getCreate();
    $products = $model->getList();
    return view('products.list', ['products' => $products],['companies' => $allCompany]);
}

//部分検索
public function Search(Request $request){
    //キーワード受け取り
    $keyword = $request->input('keyword');

    $model = new Product();
    $companies  = new Company();
    $allCompany = $companies->getCreate();
    $products = $model->Search($keyword);
    // dd($keyword);
    return view('products.list', ['products' => $products],['companies' => $allCompany]);

//   $query = Product::query();
//   return view('/list')->with(['products' => $products],['companies' => $allCompany]);
}

//登録画面表示
    public function showCreate(){
        $model = new Company;
        $companies = $model->getCreate();
        return view('products.create', ['companies' => $companies]);
    }

//登録する
    public function exeStore(CreateRequest $request) {

        //トランザクション開始
        DB::beginTransaction();
        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->createProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらcreateにリダイレクト
        return redirect(route('create'));
    }

// 画像アップロード
    public function upload(Request $request){
        // ディレクトリ名
        $dir = 'sample';

        // アップロードされた画像を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // sampleディレクトリに画像を保存
        $request->file('image')->store('public/' . $dir);

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        // ファイル情報をDBに保存
        $image = new Image();
        $image->name = $file_name;
        $image->path = 'storage/' . $dir . '/' . $file_name;
        $image->save();

        return redirect (route('list'));
    }

// 詳細画面
public function showDetail($id){   
    $model = new Product();
    $product = $model->getDetail($id);
    if (is_null($product)) {
        \Session::flash('err_msg','データがありません');
        return redirect (route('list'));
    }
    return view ('products.detail', compact('product'));
}

// 編集画面
public function showEdit($id){   
    $model = new Product();
    $product = $model->getDetail($id);
    if (is_null($product)) {
        \Session::flash('err_msg','データがありません');
        return redirect (route('list'));
    }
    return view ('products.edit', compact('product'));
}

// 更新する
public function exeupdate(CreateRequest $request) {

    // トランザクション開始
    DB::beginTransaction();
    try {
        // 登録処理呼び出し
        $model = new Product();
        $model->createProduct($request);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

    // 処理が完了したらcreateにリダイレクト
    return redirect(route('list'));
}

    // 削除ボタン
    public function exeDelete($id){
        if(empty($id)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('list'));
        }

        // トランザクション開始
        DB::beginTransaction();
        try{
            //情報を削除
            Product::destroy($id);
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg','削除されました');
        return redirect(route('list'));
    }
}