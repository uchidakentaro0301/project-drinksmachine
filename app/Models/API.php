<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 

class Item extends Model {
     use HasFactory; protected $fillable = [ 'name', 'description', ]; 
    } 



//初期設定
// <?php

// namespace App;

// use Illuminate\Database\Eloquent\Model;

// class API extends Model
// {
//     //
// }
