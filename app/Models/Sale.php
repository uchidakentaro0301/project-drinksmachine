<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model{
  protected $table = 'sales';
  protected $detes = ['created_at', 'updeted_at','updete_at'];
  protected  $fillable =['id', 'version', 'min_version'];
}

?>