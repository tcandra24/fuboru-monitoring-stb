<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Division;
use App\Models\SyncCustomer;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'pelanggan'                 => 'required|array',
                'pelanggan.*.kode'          => 'required|string',
                'pelanggan.*.nama'          => 'required|string',
                'pelanggan.*.alamat'        => 'required|string',
                'pelanggan.*.kota'          => 'required|string',
                'pelanggan.*.kode_pos'      => 'required|string',
                'pelanggan.*.kecamatan'     => 'required|string',
                'pelanggan.*.kelurahan'     => 'required|string',
                'pelanggan.*.telepon'       => 'required|string',
                'pelanggan.*.kode_divisi'   => 'required|string',
                'pelanggan.*.kode_area'   => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            Customer::upsert($request->pelanggan, ['kode'], [
                'nama',
                'alamat',
                'kota',
                'kode_pos',
                'kecamatan',
                'kelurahan',
                'telepon',
                'kode_divisi',
                'kode_area',
            ]);

            $customers = Customer::all();

            return response()->json([
                'success'   => true,
                'pelanggan' => $customers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        }
    }

    public function sync()
    {
        try {
            $syncCustomer = SyncCustomer::where('divisi', '<>', '')->where('Aktif', 1)->take(500)->orderBy('createDate', 'desc')->get();

            $arrayInsert = $syncCustomer->map(function($data){
                $division = Division::select('kode')->where('nama', 'LIKE', '%'. $data->Divisi .'%')->first();

                return [
                    'kode' => $data->KdPlg,
                    'nama' => $data->Nama,
                    'alamat' => $data->Alamat,
                    'kota' => $data->Kota,
                    'kode_pos' => '-',
                    'kecamatan' => $data->Kec,
                    'kelurahan' => '-',
                    'telepon' => $data->Telp ?? '-',
                    'kode_divisi' => $division ? $division->kode : '00/00',
                    'kode_area' => $data->Area,
                ];
            });

            Customer::upsert($arrayInsert->toArray(), ['kode'], [
                'nama',
                'alamat',
                'kota',
                'kode_pos',
                'kecamatan',
                'kelurahan',
                'telepon',
                'kode_divisi',
                'kode_area'
            ]);

            $customers = Customer::all();

            return response()->json([
                'success'   => true,
                'pelanggan' => $customers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        }
    }
}
