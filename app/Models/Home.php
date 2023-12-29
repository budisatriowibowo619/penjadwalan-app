<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Home;

class Home
{

    public static function all()
    {
        $get_tb_jadwal = DB::table('schedules')->where('status', 1)->get();

        return $get_tb_jadwal;
    }

    public function convert_nama_bulan($bulan = 0)
    {
        $text = '';
        
        if(!empty($bulan)){
            if($bulan == '1'){
                $text = 'Januari';
            } else if($bulan == '2'){
                $text = 'Februari';
            } else if($bulan == '3'){
                $text = 'Maret';
            } else if($bulan == '4'){
                $text = 'April';
            } else if($bulan == '5'){
                $text = 'Mei';
            } else if($bulan == '6'){
                $text = 'Juni';
            } else if($bulan == '7'){
                $text = 'Juli';
            } else if($bulan == '8'){
                $text = 'Agustus';
            } else if($bulan == '9'){
                $text = 'September';
            } else if($bulan == '10'){
                $text = 'Oktober';
            } else if($bulan == '11'){
                $text = 'November';
            } else if($bulan == '12'){
                $text = 'Desember';
            }
        }

        return $text;
    }

    public static function gt_penjadwalan($id = 0){

        $arr_penjadwalan = [];

        $home = new Home();

        if(!empty($id)){
            $get_penjadwalan = DB::table('schedules')->where('id', $id)->first();
            $get_room = DB::table('ms_room')->where('id', $get_penjadwalan->id_room)->first();
            $arr_penjadwalan = [
                'id'                => $get_penjadwalan->id,
                'id_room'           => $get_penjadwalan->id_room,
                'title'             => $get_penjadwalan->title,
                'description'       => $get_penjadwalan->description,
                'start_datetime'    => $get_penjadwalan->start_datetime,
                'end_datetime'      => $get_penjadwalan->end_datetime,
                'warna'             => $get_penjadwalan->warna,
                'ruangan'           => isset($get_room->nama_ruangan) ? $get_room->nama_ruangan : 0,
                'start_date'        => date("Y-m-d", strtotime($get_penjadwalan->start_datetime)),
                'end_date'          => date("Y-m-d", strtotime($get_penjadwalan->end_datetime)),
                'start_time'        => date("H:i:s", strtotime($get_penjadwalan->start_datetime)),
                'end_time'          => date("H:i:s", strtotime($get_penjadwalan->end_datetime)),
                'convert_start'     => date("d", strtotime($get_penjadwalan->start_datetime)).' '.$home->convert_nama_bulan(date("m", strtotime($get_penjadwalan->start_datetime))).' '.date("Y", strtotime($get_penjadwalan->start_datetime)).' - '.date("H:i", strtotime($get_penjadwalan->start_datetime)),
                'convert_end'       => date("d", strtotime($get_penjadwalan->end_datetime)).' '.$home->convert_nama_bulan(date("m", strtotime($get_penjadwalan->end_datetime))).' '.date("Y", strtotime($get_penjadwalan->end_datetime)).' - '.date("H:i", strtotime($get_penjadwalan->end_datetime))
            ];
        }

        return $arr_penjadwalan;

    }

    public static function prosesJadwal($params = [])
    {

        $type = isset($params['type']) ? $params['type'] : '';

        if($type == "insert") {

            $id = isset($params['id']) ? $params['id'] : 0;
            $title = isset($params['title']) ? $params['title'] : '';
            $description = isset($params['description']) ? $params['description'] : '';
            $start_date = isset($params['start_date']) ? $params['start_date'] : '0000-00-00';
            $start_time = isset($params['start_time']) ? $params['start_time'] : '0000-00-00';
            $end_date = isset($params['end_date']) ? $params['end_date'] : '00:00:00';
            $end_time = isset($params['end_time']) ? $params['end_time'] : '00:00:00';
            $ruangan = isset($params['ruangan']) ? $params['ruangan'] : 0;
            $warna = isset($params['warna']) ? $params['warna'] : 'fc-event-primary-dim';

            if(empty($id)){
                $arr_schedules = [
                    'title'             => $title,
                    'description'       => $description,
                    'start_datetime'    => $start_date.' '.$start_time,
                    'end_datetime'      => $end_date.' '.$end_time,
                    'id_room'           => $ruangan,
                    'warna'             => $warna,
                    'created_at'        => now()
                ];
            } else {
                $arr_schedules = [
                    'title'             => $title,
                    'description'       => $description,
                    'start_datetime'    => $start_date.' '.$start_time,
                    'end_datetime'      => $end_date.' '.$end_time,
                    'id_room'           => $ruangan,
                    'warna'             => $warna,
                    'updated_at'        => now()
                ];
            }

            DB::beginTransaction();

            try {

                if(empty($id)){
                    DB::table('schedules')->insert([$arr_schedules]);
                } else {
                    DB::table('schedules')->where('id', $id)->update($arr_schedules);
                }

                DB::commit();

                return true;

            }catch(\Exception $e){

                DB::rollback();

                return false;

            }

        } else if ($type == "update"){

            $id = isset($params['id']) ? $params['id'] : 0;
            $days = isset($params['days']) ? $params['days'] : 0;

            DB::beginTransaction();

                try {

                    $get_tb_jadwal = DB::table('schedules')->where('id', $id)->first();

                    $start_date = date("Y-m-d", strtotime($get_tb_jadwal->start_datetime));
                    $start_time = date("H:i:s", strtotime($get_tb_jadwal->start_datetime));
                    $end_date = date("Y-m-d", strtotime($get_tb_jadwal->end_datetime));
                    $end_time = date("H:i:s", strtotime($get_tb_jadwal->end_datetime));

                    $update_start_datetime = date("Y-m-d", strtotime("".$days." day", strtotime($start_date))).' '.$start_time;
                    $update_end_datetime = date("Y-m-d", strtotime("".$days." day", strtotime($end_date))).' '.$end_time;

                    $arr_schedules = [
                        'start_datetime'    => $update_start_datetime,
                        'end_datetime'      => $update_end_datetime,
                        'updated_at'        => now()
                    ];

                    DB::table('schedules')->where('id', $id)->update($arr_schedules);

                    DB::commit();

                    return true;

                }catch(\Exception $e){

                    DB::rollback();

                    return false;

                }

        }

    }

    public static function prosesHapusJadwal($params = [])
    {
        $id = isset($params['id']) ? $params['id'] : 0;

        DB::beginTransaction();

        try {

            $data = [
                'status'     => 9,
                'deleted_at' => now()
            ];

            DB::table('schedules')->where('id', $id)->update($data);

            DB::commit();

            return true;

        }catch(\Exception $e){

            DB::rollback();

            return false;

        }
    }

}
