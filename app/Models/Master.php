<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Master
{

    public static function select_room($params = [])
    {
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['limit']) ? $params['limit'] : 20;
        $search = isset($params['search']) ? $params['search'] : '';

        $query = DB::table('ms_room')
                    ->select('id', DB::raw('nama_ruangan as text'))
                    ->where('status','=',1)
                    ->where(function ($query) use ($search) {
                        $query->where('nama_ruangan','like','%'.$search.'%');
                    })
                    ->orderBy('nama_ruangan', 'ASC')
                    ->offset($start)
                    ->limit($limit);
        
        $response = [
            'query' => $query->get(),
            'count' => $query->count()
        ];

        return $response;

    }

}
