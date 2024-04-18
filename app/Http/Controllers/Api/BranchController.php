<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Branch;
use App\Models\SyncBranch;

class BranchController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'area'          => 'required|array',
                'area.*.kode'   => 'required|string',
                'area.*.nama'   => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            Branch::upsert($request->area, ['kode'], ['nama']);

            $branches = Branch::all();

            return response()->json([
                'success'   => true,
                'cabang'    => $branches
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
            $syncBranch = SyncBranch::all();
            $arrayInsert = $syncBranch->map(function($data){
                return [
                    'kode' => $data->Kode,
                    'nama' => $data->Cabang,
                ];
            });

            Branch::upsert($arrayInsert->toArray(), ['kode'], ['nama']);

            $branches = Branch::all();
            return response()->json([
                'success' => true,
                'area' => $branches
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        }
    }
}
