<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Inertia\Inertia;

// use App\Models\MasterStb;
// use App\Models\DetailStb;
use App\Models\Stb;
use Illuminate\Support\Facades\Auth;

class StbController extends Controller
{
    public function index()
    {
        // $masterStb = MasterStb::with('customer', 'branch', 'salesman')
        // ->withSum('detailStb', 'omset')
        // ->when(Auth::user()->kode_area, function($query){
        //     $query->where('kode_area', Auth::user()->kode_area);
        // })
        // ->when(Auth::user()->kode_pelanggan, function($query){
        //     $query->where('kode_pelanggan', Auth::user()->kode_pelanggan);
        // })->orderBy('periode_awal', 'desc')->paginate(10);

        $masterStb = Stb::when(Auth::user()->kode_area, function($query){
            $query->where('area', Auth::user()->kode_area);
        })
        ->when(request()->customerName, function($query){
            $query->where('nmplg', 'LIKE', '%' . request()->customerName . '%');
        })
        ->when(request()->dateStart, function($query){
            $query->whereDate('awal', '>=', request()->dateStart);
        })
        ->when(request()->dateEnd, function($query){
            $query->whereDate('akhir', '<=', request()->dateEnd);
        })
        ->when(request()->isInsert, function($query){
            if(request()->isInsert === 'Y'){
                $query->where('is_insert', 1);
            } else {
                $query->whereNull('is_insert');
            }
        })
        // ->when(Auth::user()->kode_pelanggan, function($query){
        //     $query->where('kdplg', Auth::user()->kode_pelanggan);
        // })
        ->whereNotNull('approve3date')
        ->where('approvelevel', 4)
        ->orderBy('approve3date', 'desc')
        ->paginate(10)->withQueryString();

        return Inertia::render('Report/STB/Index', [
            'masterStb' => $masterStb,
        ]);
    }

    // public function show($nomer_kontrak)
    // {
    //     $masterStb = MasterStb::with('customer', 'branch', 'salesman')->withSum('detailStb', 'omset')->where('nomer_kontrak', $nomer_kontrak)
    //     ->when(Auth::user()->kode_area, function($query){
    //         $query->where('kode_area', Auth::user()->kode_area);
    //     })
    //     ->when(Auth::user()->kode_pelanggan, function($query){
    //         $query->where('kode_pelanggan', Auth::user()->kode_pelanggan);
    //     })->first();

    //     $detailStb = DetailStb::where('nomer_kontrak', $nomer_kontrak)->orderBy('tahun')->orderBy('bulan')->get();

    //     return Inertia::render('Report/Show', [
    //         'masterStb' => $masterStb,
    //         'detailStb' => $detailStb,
    //     ]);
    // }
}
