<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Models\Stb;

class StbExport implements FromView
{
    public $customerName;
    public $dateStart;
    public $dateEnd;
    public $isInsert;

    public function __construct($data) {
        $this->customerName = $data['customerName'];
        $this->dateStart = $data['dateStart'];
        $this->dateEnd = $data['dateEnd'];
        $this->isInsert = $data['isInsert'];
    }

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
        ->when($this->customerName, function($query){
            $query->where('nmplg', 'LIKE', '%' . $this->customerName . '%');
        })
        ->when($this->dateStart, function($query){
            $query->whereDate('awal', '>=', $this->dateStart);
        })
        ->when($this->dateEnd, function($query){
            $query->whereDate('akhir', '<=', $this->dateEnd);
        })
        ->when($this->isInsert, function($query){
            if($this->isInsert === 'Y'){
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
        // ->whereNull('is_insert')
        ->orderBy('approve3date', 'desc')->get();

        return view('exports.stb', [
            'masterStb' => $masterStb
        ]);
    }
}
