<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\MasterStb;
use App\Models\DetailStb;
use Illuminate\Support\Facades\Auth;

class StbController extends Controller
{
    public function index()
    {
        $masterStb = MasterStb::with('customer', 'branch', 'salesman')
        ->withSum('detailStb', 'omset')
        ->when(Auth::user()->kode_area, function($query){
            $query->where('kode_area', Auth::user()->kode_area);
        })
        ->when(Auth::user()->kode_pelanggan, function($query){
            $query->where('kode_pelanggan', Auth::user()->kode_pelanggan);
        })->orderBy('periode_awal', 'desc')->paginate(10);

        return Inertia::render('Report/Index', [
            'masterStb' => $masterStb,
        ]);
    }

    public function show($nomer_kontrak)
    {
        $masterStb = MasterStb::with('customer', 'branch', 'salesman')->withSum('detailStb', 'omset')->where('nomer_kontrak', $nomer_kontrak)
        ->when(Auth::user()->kode_area, function($query){
            $query->where('kode_area', Auth::user()->kode_area);
        })
        ->when(Auth::user()->kode_pelanggan, function($query){
            $query->where('kode_pelanggan', Auth::user()->kode_pelanggan);
        })->first();

        $detailStb = DetailStb::where('nomer_kontrak', $nomer_kontrak)->orderBy('tahun')->orderBy('bulan')->get();

        return Inertia::render('Report/Show', [
            'masterStb' => $masterStb,
            'detailStb' => $detailStb,
        ]);
    }
}