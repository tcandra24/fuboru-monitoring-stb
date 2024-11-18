<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Models\Stb;

class StbExport implements FromView
{
    /**
     * view
     *
     * @return View
     */
    public function view(): View
    {
        $masterStb = Stb::when(Auth::user()->kode_area, function($query){
            $query->where('area', Auth::user()->kode_area);
        })
        ->when(Auth::user()->kode_pelanggan, function($query){
            $query->where('kdplg', Auth::user()->kode_pelanggan);
        })
        ->whereNotNull('approve3date')
        ->whereNull('is_insert')
        ->orderBy('approve3date', 'desc')->get();

        return view('exports.stb', [
            'masterStb' => $masterStb
        ]);
    }
}
