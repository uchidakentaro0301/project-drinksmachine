<?php

namespace App\Http\Controllers;

// 追加
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $products_model = new Products;
        $companies = new Company;
        $allCompany = $companies->getCompanies();
        $products = $products_model->getProducts();
        return view('product.list', [
            'companies'=>$allCompany , 
            'products'=> $products,
        ]);
    }

    // 一覧を表示させる（Json形式）
    public function ajaxGet(){ 

        $products = new Product;
        $selectedProducts = $products -> getlist();

        return response()->json($selectedProducts); 
    }

    //検索機能
    public function ajaxSearch(Request $request){

        $word = $request->word;
        $selectedCompany = $request->company;
        $upperPriceLimit = $request->upperPriceLimit;
        $lowerPriceLimit = $request->lowerPriceLimit;
        $upperStockLimit = $request->upperStockLimit;
        $lowerStockLimit = $request->lowerStockLimit;

        $selectedProducts = $products->searchProducts($word,$selectedCompany,$upperPriceLimit,$lowerPriceLimit,$upperStockLimit,$lowerStockLimit);
        return response()->json($selectedProducts);
    }

    public function ajaxSort(Request $request){
        $word = $request->word;
        $selectedCompany = $request->company;
        $upperPriceLimit = $request->upperPriceLimit;
        $lowerPriceLimit = $request->lowerPriceLimit;
        $upperStockLimit = $request->upperStockLimit;
        $lowerStockLimit = $request->lowerStockLimit;
        $pressedButton = $request->pressedButton;
        $sortToggle = $request->sortToggle;
        $companies = new Company;
        $products = new Product;
        $allCompany = $companies->getCompanies();
        if(!isset($upperPriceLimit)){
            $upperPriceLimit = 9999;
        }
        if(!isset($lowerPriceLimit)){
            $lowerPriceLimit = 0;
        }
        if(!isset($upperStockLimit)){
            $upperStockLimit = 9999;
        }
        if(!isset($lowerStockLimit)){
            $lowerStockLimit = 0;
        }
        $upperPriceLimit = (int)$upperPriceLimit;
        $lowerPriceLimit = (int)$lowerPriceLimit;
        $upperStockLimit = (int)$upperStockLimit;
        $lowerStockLimit = (int)$lowerStockLimit;

        if(!isset($word)){
            $word = '%';
        }
        if(!isset($selectedCompany)){
            $selectedCompany = '%';
        }
        $selectedProducts = $products->searchProducts($word,$selectedCompany,$upperPriceLimit,$lowerPriceLimit,$upperStockLimit,$lowerStockLimit,$pressedButton,$sortToggle);
        return response()->json($selectedProducts);
    }

    public function ajaxDelete(Request $request){
        $id = $request->id;
        $word = $request->word;
        $selectedCompany = $request->company;
        $upperPriceLimit = $request->upperPriceLimit;
        $lowerPriceLimit = $request->lowerPriceLimit;
        $upperStockLimit = $request->upperStockLimit;
        $lowerStockLimit = $request->lowerStockLimit;
        $pressedButton = $request->pressedButton;
        $sortToggle = $request->sortToggle;
        $companies = new Company;
        $products = new Product;
        $allCompany = $companies->getCompanies();
        $product = Product::find($id);

        \DB::beginTransaction();
        try{
            Product::destroy($id);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        // 数が入力がされなかった場合の値を設定
        if(!isset($pressedButton)){
            $pressedButton = 'id';
        }
        if(!isset($upperPriceLimit)){
            $upperPriceLimit = 9999;
        }
        if(!isset($lowerPriceLimit)){
            $lowerPriceLimit = 0;
        }
        if(!isset($upperStockLimit)){
            $upperStockLimit = 9999;
        }
        if(!isset($lowerStockLimit)){
            $lowerStockLimit = 0;
        }
        $upperPriceLimit = (int)$upperPriceLimit;
        $lowerPriceLimit = (int)$lowerPriceLimit;
        $upperStockLimit = (int)$upperStockLimit;
        $lowerStockLimit = (int)$lowerStockLimit;

        if(!isset($word)){
            $word = '%';
        }
        if(!isset($selectedCompany)){
            $selectedCompany = '%';
        }

        Storage::delete($product->product_image);
        $selectedProducts = $products->searchProducts($word,$selectedCompany,$upperPriceLimit,$lowerPriceLimit,$upperStockLimit,$lowerStockLimit,$pressedButton,$sortToggle);
        return response()->json($selectedProducts);
    }
}