<?php

namespace App\Http\Controllers\Admin\Report\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;
use Carbon\Carbon;

class ChangeStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($kode_pelanggan)
    {
        $kode_pelanggan = str_replace('-', '/', $kode_pelanggan);

        Banner::where('KdPlg', $kode_pelanggan)
        ->where(function($query){
            $query->where('ispengajuan', true)->whereNull('tglpengiriman');
        })
        ->orWhere(function($query){
            $query->whereRaw("tglpengiriman < tglpengajuan");
        })
        ->update([
            'ispengajuan' => 0,
            'tglpengiriman' => Carbon::now()
        ]);

        return redirect()->route('report.banner.index');
    }
}
