<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;

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
                'kode_divisi'
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
