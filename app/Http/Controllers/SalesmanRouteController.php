<?php

namespace App\Http\Controllers;

use App\SalesmanList;
use App\SalesmanRoute;
use App\CustomerMasterFile;
use App\TblRoutesLogs;
use \PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesmanRouteController extends Controller
{
    public function getSalesman()
    {
        // $try =  SalesmanList::all();
        // return $try;
        return SalesmanList::select(
            'salesman_lists.id as id',
            'salesman_lists.first_name',
            'salesman_lists.last_name',
            'salesman_lists.user_code as salesman_code',
            'tbl_hepe_de_viaje.first_name AS hepe_firstname',
            'tbl_hepe_de_viaje.last_name AS hepe_lastname',
            'tbl_hepe_de_viaje.user_code AS hepe_code'
        )
            ->join('tbl_hepe_salesman', 'tbl_hepe_salesman.salesman_code', '=', 'salesman_lists.user_code')
            ->join(
                'tbl_hepe_de_viaje',
                'tbl_hepe_de_viaje.user_code',
                '=',
                'tbl_hepe_salesman.hepe_code'
            )
            ->get();

        // SELECT
        //     salesman_lists.id,
        //     salesman_lists.first_name,
        //     salesman_lists.last_name,
        //     salesman_lists.user_code as salesman_code,
        //     tbl_hepe_de_viaje.first_name AS hepe_firstname,
        //     tbl_hepe_de_viaje.last_name AS hepe_lastname,
        //     tbl_hepe_de_viaje.user_code AS hepe_code
        // FROM
        //     salesman_lists
        // JOIN tbl_hepe_salesman ON tbl_hepe_salesman.salesman_code = salesman_lists.user_code
        // LEFT JOIN tbl_hepe_de_viaje ON tbl_hepe_de_viaje.user_code = tbl_hepe_salesman.hepe_code
    }

    public function getTownList()
    {
        return DB::table('tbl_municipality_masterfile')
            ->select('tbl_municipality_masterfile.*')
            ->get();
    }

    public function getSalesmanRoutes($salesman_code)
    {
        return SalesmanRoute::where('salesman_code', $salesman_code)->get();
    }

    public function postSchedule(Request $request)
    {
        $salesman_code = $request->code;

        DB::beginTransaction();

        $rows = $request->rows;

        $towns_count = [];

        foreach ($rows as $key => $row) {
            $towns = $row['towns'];

            $towns_count[] = $row['towns'];

            SalesmanRoute::where('salesman_code', $salesman_code)
                ->where('booking_day', $row['booking'])
                ->where('del_day', $row['delivery'])
                ->each(function ($s) use ($towns) {
                    foreach ($towns as $key => $town) {
                        if ($town != $s->mun_id) {
                            $s->delete();
                        }
                    }
                });

            foreach ($towns as $town) {
                SalesmanRoute::updateOrCreate([
                    'salesman_code' => $salesman_code,
                    'mun_id' => $town,
                    'booking_day' => $row['booking'],
                    'batch_no' => $row['batch'],
                    'del_day' => $row['delivery']
                ]);

                TblRoutesLogs::create([
                    'salesman_code' => $salesman_code,
                    'mun_id' => $town,
                    'booking_day' => $row['booking'],
                    'batch_no' => $row['batch'],
                    'del_day' => $row['delivery']
                ]);
            }
        }

        DB::commit();
    }

    public function print()
    {
        $code = request()->code;
        $data = $this->datas();
        $result = DB::table('salesman_lists')->where('user_code', $code)->get();
        foreach ($result as $find) {
            // dd($find->first_name);
            $pdf = PDF::loadView('reports.salesman_route', ['datas' => $data]);
            return $pdf->download('Salesman - ' . $find->first_name . ' ' . $find->last_name . ' [ ' . $code .  ' ].pdf');
        }
    }

    public function query()
    {
        // SELECT
        // salesman_routes.*,
        // salesman_lists.first_name,
        // salesman_lists.last_name,
        // salesman_lists.user_code,
        // tbl_hepe_de_viaje.first_name AS hepe_firstname,
        // tbl_hepe_de_viaje.last_name AS hepe_lastname,
        // tbl_hepe_de_viaje.user_code AS hepe_code
        // FROM
        //     salesman_routes
        // JOIN tbl_hepe_salesman ON tbl_hepe_salesman.salesman_code = salesman_routes.salesman_code
        // JOIN salesman_lists ON salesman_lists.user_code = salesman_routes.salesman_code
        // LEFT JOIN tbl_hepe_de_viaje ON tbl_hepe_de_viaje.user_code = tbl_hepe_salesman.hepe_code
        // WHERE
        //     salesman_routes.salesman_code = 'DSG-S01'
    }

    public function datas()
    {
        $data = [];
        $salesman_code = request()->code;

        $gethead = DB::table('salesman_routes')
            ->select(
                'salesman_routes.salesman_code',
                'tbl_municipality_masterfile.mun_name AS municipality',
                'salesman_routes.booking_day',
                'salesman_routes.batch_no',
                'salesman_routes.del_day',
                'salesman_lists.first_name AS first_name',
                'salesman_lists.last_name AS last_name',
                'salesman_lists.user_code AS salesman_code',
                'tbl_hepe_de_viaje.first_name AS hepe_firstname',
                'tbl_hepe_de_viaje.last_name AS hepe_lastname',
                'tbl_hepe_de_viaje.user_code AS hepe_code'
            )
            ->join('tbl_hepe_salesman', 'tbl_hepe_salesman.salesman_code', '=', 'salesman_routes.salesman_code')
            ->join('salesman_lists', 'salesman_lists.user_code', '=', 'salesman_routes.salesman_code')
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.id', '=', 'salesman_routes.mun_id')
            ->leftJoin('tbl_hepe_de_viaje', 'tbl_hepe_de_viaje.user_code', '=', 'tbl_hepe_salesman.hepe_code')
            ->where('salesman_routes.salesman_code', '=', $salesman_code)
            ->get()->groupBy(['booking_day', 'del_day']);

        // dd($gethead);

        $arr = [];

        foreach ($gethead as $key => $booking_day) {
            foreach ($booking_day as $key2 => $del_day) {
                $arr["$booking_day - $del_day"] = [];
                foreach ($del_day as $key3 => $data) {
                    $arr["$booking_day - $del_day"][] = $data;
                }
            }
        }

        dd($arr);

        foreach ($gethead as $datahead) {
            $test = [];

            $test[] = $datahead->municipality;

            // foreach ($datahead->mun_id as $row1) {
            // dump($datahead->mun_id);
            // }

            // dump($test);
            $data[] = array(
                'first_name'        =>  $datahead->first_name,
                'last_name'         =>  $datahead->last_name,
                'salesman_code'     =>  $datahead->salesman_code,
                'hepe_firstname'    =>  $datahead->hepe_firstname,
                'hepe_lastname'     =>  $datahead->hepe_lastname,
                'hepe_code'         =>  $datahead->hepe_code,
                'datas'             =>  $test,
                'batch_no'          =>  $datahead->batch_no
            );
        }

        return $data;
    }
}
