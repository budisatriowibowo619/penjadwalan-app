<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            "name"  =>  "test",
            "page"  =>  "Home",
            "data"  =>  Home::all()
        ]);
    }

    public function ajax_gt_all_tb_jadwal(Request $request)
    {
        $arr_jadwal = [];

        
            $gt_data_jadwal = Home::all();

            if(!empty($gt_data_jadwal)){
                foreach($gt_data_jadwal as $row){

                    $arr_jadwal[] = [
                        "title" => $row->title,
                        "start" => $row->start_datetime,
                        "end"   => $row->end_datetime
                    ];

                }
            }

        return $arr_jadwal;
    }

    public function addJadwal(){
        
    }

}
