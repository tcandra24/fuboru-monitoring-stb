<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterStb;
use App\Models\DetailStb;
use App\Models\Branch;
use App\Models\Salesman;
use App\Models\Customer;

class StbController extends Controller
{
    public function sync(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'reportStb'                     => 'required|array',
                'reportStb.*.nomer_kontrak'     => 'required|string',
                'reportStb.*.kode_pelanggan'    => 'required|string',
                'reportStb.*.kode_salesman'     => 'required|string',
                'reportStb.*.periode_awal'      => 'required',
                'reportStb.*.periode_akhir'     => 'required',
                'reportStb.*.target_rp'         => 'required',
                'reportStb.*.hadiah_persen'     => 'required',
                'reportStb.*.detail'            => 'required|array',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $masterArray = [];
            $detailArray = [];

            $msgSuccess = [];
            $msgErrors = [];

            foreach($request->reportStb as $masterStb){
                if(!Branch::where('kode', $masterStb['kode_area'])->exists()){
                    array_push($msgErrors, "Kode area " . $masterStb['kode_area'] . " masih tidak ada");
                    continue;
                }

                if(!Customer::where('kode', $masterStb['kode_pelanggan'])->exists()){
                    array_push($msgErrors, "Kode pelanggan " . $masterStb['kode_pelanggan'] . " masih tidak ada");
                    continue;
                }

                if(!Salesman::where('kode', $masterStb['kode_salesman'])->exists()){
                    array_push($msgErrors, "Salesman " . $masterStb['kode_salesman'] . " masih tidak ada");
                    continue;
                }

                array_push($masterArray, [
                    'nomer_kontrak'     => $masterStb['nomer_kontrak'],
                    'kode_pelanggan'    => $masterStb['kode_pelanggan'],
                    'kode_area'         => $masterStb['kode_area'],
                    'kode_salesman'     => $masterStb['kode_salesman'],
                    'periode_awal'      => $masterStb['periode_awal'],
                    'periode_akhir'     => $masterStb['periode_akhir'],
                    'target_rp'         => $masterStb['target_rp'],
                    'hadiah_persen'     => $masterStb['hadiah_persen'],
                ]);

                foreach($masterStb['detail'] as $detailStb){
                    array_push($detailArray, [
                        'nomer_kontrak' => $masterStb['nomer_kontrak'],
                        'tahun'         => $detailStb['tahun'],
                        'bulan'         => $detailStb['bulan'],
                        'omset'         => $detailStb['omset'],
                        'total'         => $detailStb['total'],
                        'persentase'    => $detailStb['persentase'],
                    ]);
                }

                array_push($msgSuccess, "Nomer Kontrak " . $masterStb['nomer_kontrak'] . " berhasil di input");
            }

            MasterStb::upsert($masterArray, ['nomer_kontrak'], [
                'kode_pelanggan',
                'kode_area',
                'periode_awal',
                'periode_akhir',
                'target_rp',
                'hadiah_persen',
            ]);

            DetailStb::upsert($detailArray, ['nomer_kontrak', 'tahun', 'bulan'], [
                'omset',
                'total',
                'persentase',
            ]);

            return response()->json([
                'success'   => true,
                'message'   => [
                    $msgSuccess,
                    $msgErrors
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        }
    }
}
