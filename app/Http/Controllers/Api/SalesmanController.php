<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Salesman;

class SalesmanController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'salesman'          => 'required|array',
                'salesman.*.kode'   => 'required|string',
                'salesman.*.nama'   => 'required|string',
                'salesman.*.alamat' => 'required|string',
                'salesman.*.kota'   => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            Salesman::upsert($request->salesman, ['kode'], [
                'nama',
                'alamat',
                'kota',
            ]);

            $salesmans = Salesman::all();

            return response()->json([
                'success'   => true,
                'salesman'  => $salesmans
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        }
    }
}
