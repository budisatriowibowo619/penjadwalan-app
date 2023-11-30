<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                        "id"    => $row->id,
                        "title" => $row->title,
                        "start" => $row->start_datetime,
                        "end"   => $row->end_datetime
                    ];

                }
            }

        return $arr_jadwal;
    }

    public function ajax_proses_jadwal(Request $request){

        if(empty($request->id)){

            $validator = Validator::make($request->all(), [
                'title'         => 'required|max:255',
                'description'   => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => implode(",",$validator->errors()->all())
                ]);
            }
            
            Home::prosesJadwal([
                'type'          => 'insert',
                'title'         => $request->title,
                'description'   => $request->description,
                'start_date'    => $request->start_date, 
                'start_time'    => $request->start_time,
                'end_date'      => $request->end_date,
                'end_time'      => $request->end_time
            ]);        

            return response()->json(['status' => true]);

        } else {

            $validator = Validator::make($request->all(), [
                'id'            => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required'
            ]);


            Home::prosesJadwal([
                'type'          => 'update',
                'id'            => $request->id,
                'days'          => $request->days
            ]);   

            return response()->json(['status' => true]);

        }

    }

    public function ajax_proses_hapus_jadwal(Request $request) {

        $validator = Validator::make($request->all(), [
            'id'        => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => implode(",",$validator->errors()->all())
            ]);
        }

        Home::prosesHapusJadwal([
            'id' => $request->id
        ]);   

        return response()->json(['status' => true]);

    }

}
