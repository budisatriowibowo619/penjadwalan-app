<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\Home;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('auth/home', [
                'page'      => 'Home',
                'js_script' => '/js/auth/home.js' 
            ]);
        } else {
            return view('home', [
                'page'      => 'Home',
                'js_script' => '/js/home.js' 
            ]);
        }
    }

    public function ajax_gt_all_tb_jadwal(Request $request)
    {

        // if($request->ajax()) {
        
            $arr_jadwal = [];

            
                $gt_data_jadwal = Home::all();

                if(!empty($gt_data_jadwal)){
                    foreach($gt_data_jadwal as $row){

                        $arr_jadwal[] = [
                            'id'        => $row->id,
                            'title'     => $row->title,
                            'start'     => $row->start_datetime,
                            'end'       => $row->end_datetime,
                            'className' => $row->warna
                        ];

                    }
                }

            return $arr_jadwal;

        // }

    }

    public function ajax_process_jadwal(Request $request)
    {

        if($request->ajax()) {
            
            if(empty($request->eventtype)){

                $validator = Validator::make($request->all(), [
                    'title'         => 'required|max:255',
                    'description'   => 'required',
                    'start_date'    => 'required',
                    'end_date'      => 'required',
                    'ruangan'       => 'required'
                ]);

                if ($validator->fails()) {
                    return response()->json(implode(',',$validator->errors()->all()), 422);
                }
                
                Home::prosesJadwal([
                    'type'          => 'insert',
                    'id'            => $request->id,
                    'title'         => $request->title,
                    'description'   => $request->description,
                    'start_date'    => $request->start_date, 
                    'start_time'    => $request->start_time,
                    'end_date'      => $request->end_date,
                    'end_time'      => $request->end_time,
                    'ruangan'       => $request->ruangan,
                    'warna'         => $request->warna_tampilan
                ]);        

                return response()->json([
                    'status'    => TRUE,
                    'message'   => 'Jadwal berhasil disimpan!'
                ],200);

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

                return response()->json([
                    'status'    => TRUE,
                    'message'   => 'Jadwal berhasil diperbarui!'
                ],200);

            }

        }

    }

    public function ajax_delete_jadwal(Request $request)
    {
        if($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'id'        => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(implode(",",$validator->errors()->all()), 422);
            }

            Home::prosesHapusJadwal([
                'id' => $request->id
            ]);   

            return response()->json([
                'status'    => TRUE,
                'message'   => 'Jadwal berhasil dihapus!'
            ],200);
            
        }

    }

    public function ajax_gt_penjadwalan(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'required'
            ]);

            if($validator->fails()) {
                return response()->json(implode(',',$validator->errors()->all()), 422);
            }
            
            $gt_penjadwalan = Home::gt_penjadwalan($request->id);
            return response()->json($gt_penjadwalan);

        }
    }

    // public function insert_user()
    // {
    //     $test = Home::insert_user();

    //     print_r($test); exit;
    // }

}
