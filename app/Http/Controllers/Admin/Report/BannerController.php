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
            ->paginate(10);

        return Inertia::render('Report/Banner/Index', [
            'masterBanner' => $masterBanner,
        ]);
    }
}
