<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home
{

    public static function all()
    {
        $get_tb_jadwal = DB::table('tb_jadwal')->get();

        return $get_tb_jadwal;
    }

    public static function ajax_gt_all_tb_jadwal()
    {
        
    }

}
