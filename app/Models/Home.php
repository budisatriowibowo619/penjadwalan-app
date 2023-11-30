<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home
{

    public static function all()
    {
        $get_tb_jadwal = DB::table('schedules')->where('status', 1)->get();

        return $get_tb_jadwal;
    }

    public static function prosesJadwal($params = [])
    {

        $type = isset($params['type']) ? $params['type'] : '';

        if($type == "insert") {

            $title = isset($params['title']) ? $params['title'] : '';
            $description = isset($params['description']) ? $params['description'] : '';
            $start_date = isset($params['start_date']) ? $params['start_date'] : '0000-00-00';
            $start_time = isset($params['start_time']) ? $params['start_time'] : '0000-00-00';
            $end_date = isset($params['end_date']) ? $params['end_date'] : '00:00:00';
            $end_time = isset($params['end_time']) ? $params['end_time'] : '00:00:00';

            $arr_schedules = [
                'title'             => $title,
                'description'       => $description,
                'start_datetime'    => $start_date.' '.$start_time,
                'end_datetime'      => $end_date.' '.$end_time,
                'created_at'        => now()
            ];

            DB::beginTransaction();

            try {

                DB::table('schedules')->insert([$arr_schedules]);

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
