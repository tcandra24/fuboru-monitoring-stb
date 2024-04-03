<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Division;

class DivisionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'divisi'          => 'required|array',
                'divisi.*.kode'   => 'required|string',
                'divisi.*.nama'   => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            Division::upsert($request->divisi, ['kode'], ['nama']);

            $division = Division::all();

            return response()->json([
                'success'   => true,
                'divisi'    => $division
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        }
    }
}
