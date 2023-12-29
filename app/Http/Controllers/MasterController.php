<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    
    public function ajax_select_room(Request $request)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'page'   => 'required'
            ]);

            if($validator->fails()) {
                return response()->json(implode(',',$validator->errors()->all()), 422);
            }

            $start = $request->page;
            $limit = 20;

            if($start <= 0){
                $start = 1;
            }

            $select_master_room = Master::select_room([
                'start'     => ceil($start - 1) * 20,
                'limit'     => $limit,
                'search'    => $request->search
            ]);

            $response = [
                'results'    => $select_master_room['query'],
                'pagination' => [
                    'more'  => ($start * 20) < $select_master_room['count']
                ]
            ];

            return response()->json($response);
        }
    }

}
