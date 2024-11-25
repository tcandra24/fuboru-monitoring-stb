<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BannerController extends Controller
{
    public function index()
    {
        $masterBanner = Banner::where('KdPlg', '<>' , '')
            // ->where(function($query){
            //     $query->where('ispengajuan', true)->whereNull('tglpengiriman');
            // })
            // ->orWhere(function($query){
            //     $query->whereRaw("tglpengiriman < tglpengajuan");
            // })
            ->when(request()->customerName, function($query){
                $query->where('Nama', 'LIKE', '%' . request()->customerName . '%');
            })
            ->when(request()->city, function($query){
                $query->where('Kota', request()->city);
            })
            // ->when(request()->submissionDate, function($query){
            //     $query->whereDate('tglpengajuan', '<=', request()->dateEnd);
            // })
            ->orderBy('tglpengajuan', 'desc')
            ->paginate(10)->withQueryString();

        $cities = Banner::distinct()->selectRaw('Kota as city')->where('KdPlg', '<>' , '')->orderBy('Kota')->get();

        return Inertia::render('Report/Banner/Index', [
            'masterBanner' => $masterBanner,
            'cities' => $cities
        ]);
    }
}
