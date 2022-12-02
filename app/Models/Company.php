<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{ 
    // テーブル名
    protected $table = 'companies';

    // 可変項目
    protected $fillable =
    [
        'company_name',
        'street_address',
        'representative_name',
    ];

    // 一覧画面表示
    public function getCreate() {
        // Companyテーブルからデータを取得
        $companies = DB::table('companies')
        ->get();

        return $companies;
    }
}

