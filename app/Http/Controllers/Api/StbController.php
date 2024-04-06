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
use Illuminate\Support\Facades\DB;

class StbController extends Controller
{
    private $msgSuccess = [];
    private $msgErrors = [];

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

            DB::transaction(function() use ($request){
                foreach($request->reportStb as $masterStb){
                    if(!Branch::where('kode', $masterStb['kode_area'])->exists()){
                        array_push($this->msgErrors, "Kode area " . $masterStb['kode_area'] . " masih tidak ada");
                        continue;
                    }

                    if(!Customer::where('kode', $masterStb['kode_pelanggan'])->exists()){
                        array_push($this->msgErrors, "Kode pelanggan " . $masterStb['kode_pelanggan'] . " masih tidak ada");
                        continue;
                    }

                    if(!Salesman::where('kode', $masterStb['kode_salesman'])->exists()){
                        array_push($this->msgErrors, "Salesman " . $masterStb['kode_salesman'] . " masih tidak ada");
                        continue;
                    }

                    MasterStb::updateOrCreate(
                        ['nomer_kontrak' => $masterStb['nomer_kontrak']],
                        [
                            'kode_pelanggan'    => $masterStb['kode_pelanggan'],
                            'kode_area'         => $masterStb['kode_area'],
                            'kode_salesman'     => $masterStb['kode_salesman'],
                            'periode_awal'      => $masterStb['periode_awal'],
                            'periode_akhir'     => $masterStb['periode_akhir'],
                            'target_rp'         => $masterStb['target_rp'],
                            'hadiah_persen'     => $masterStb['hadiah_persen'],
                        ]
                    );

                    foreach($masterStb['detail'] as $detailStb){
                        DetailStb::updateOrCreate(
                            [
                                'nomer_kontrak' => $masterStb['nomer_kontrak'],
                                'tahun' => (int)$detailStb['tahun'],
                                'bulan' => (int)$detailStb['bulan']
                            ],
                            [
                                'omset' => $detailStb['omset'],
                                'total' => $detailStb['total'],
                                'kode_salesman' => $masterStb['kode_salesman'],
                                'persentase' => $detailStb['persentase'],
                            ]
                        );
                    }

                    array_push($this->msgSuccess, "Nomer Kontrak " . $masterStb['nomer_kontrak'] . " berhasil di input");
                }
            });

            return response()->json([
                'success'   => true,
                'message'   => [
                    $this->msgSuccess,
                    $this->msgErrors
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
