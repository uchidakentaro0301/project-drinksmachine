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
    public function createProduct($product) {
        // 登録処理
        DB::table('products')->insert([
            'company_id' => $product->company_id,
            'product_name' => $product->product_name,
            'price' => $product->price,
            'stock' => $product->stock,
            'comment' => $product->comment,
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
}