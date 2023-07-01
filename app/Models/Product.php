<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{ 
    // テーブル名
    protected $table = 'products';

    // 可変項目
    protected $fillable =
    [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
    ];

    // 一覧画面表示
    public function getList() {
        // Productテーブルからデータを取得
        $products = DB::table('products')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->get();

        return $products;
    }

    // 詳細画面表示
    public function getDetail($id) {
        // Productテーブルからデータを取得
        $product = DB::table("products")
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id', '=', $id)
            ->first();

        return $product;
    }

// 登録画面
    public function createProduct($product,$file_name) {
        // 登録処理
        $path = 'storage/'. $file_name;

        DB::table('products')->insert([
            'company_id' => $product->company_id,
            'product_name' => $product->product_name,
            'price' => $product->price,
            'stock' => $product->stock,
            'comment' => $product->comment,
            'img_path'  => $path,
        ]);
    }

 //編集画面
 public function getEdit($id) {
    // Productテーブルからデータを取得
    $product = DB::table("products")
        ->join('companies', 'company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name')
        ->where('products.id', '=', $id)
        ->first();

    return $product;
}

// 検索機能（商品名検索）
public function Search($keyword) {
    // Productテーブルからデータを取得
    $products = DB::table('products')
        ->join('companies', 'company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name')
        ->where('products.product_name', 'like',"%$keyword%" )
        ->get();

    return $products;
}


// Step8の範囲

//ajax一覧画面
public function getProducts(){
    return DB::table('products')
    ->join('companies','products.company_id','=','companies.id')
    ->select('products.*','companies.company_name')
    ->get();
}

public function searchProducts($word,$selectedCompany,$upperPriceLimit,$lowerPriceLimit,$upperStockLimit,$lowerStockLimit){
    return DB::table('products')
            ->join('companies','products.company_id','=','companies.id')
            ->select('products.*','companies.company_name')
            ->where('product_name', 'LIKE', '%'.$word.'%')
            ->where('companies.id', '=', $selectedCompany)
            ->whereBetween('products.price',[$lowerPriceLimit,$upperPriceLimit])
            ->whereBetween('products.stock',[$lowerStockLimit,$upperStockLimit])
            // ->orderBy($pressedButton,$sortToggle)
            // ->orderBy('id','DESC')
            ->get();
}

public function getProductsById($id){
    return DB::table('products')
            ->join('companies','products.company_id','=','companies.id')
            ->select('products.*','companies.company_name')
            ->where('products.id','=',$id)
            ->first();
}
}