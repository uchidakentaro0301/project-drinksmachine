<?php

 namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Item; class ItemController 
  
extends Controller { 
    public function update(Request $request, $id) { $item = Item::findOrFail($id); 
        $item->name = $request->input('name'); 
        $item->description = $request->input('description');
         $item->save(); return response()->json(['message' => 'Item updated successfully']); 
        } 
    } 


    
//初期設定
// <?php

// namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

// class VerController extends Controller
// {
//     //
// }
