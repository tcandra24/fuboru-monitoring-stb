<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Models\Banner;

class BannerExport implements FromView
{
    public $customerName;
    public $city;

    public function __construct($data) {
        $this->customerName = $data['customerName'];
        $this->city = $data['city'];
    }

    /**
     * view
     *
     * @return View
     */
    public function view(): View
    {
        $masterBanner = Banner::where('KdPlg', '<>' , '')
            ->when($this->customerName, function($query){
                $query->where('Nama', 'LIKE', '%' . $this->customerName . '%');
            })
            ->when($this->city, function($query){
                $query->where('Kota', $this->city);
            })
            ->orderBy('tglpengajuan', 'desc')
            ->get();

        return view('exports.banner', [
            'masterBanner' => $masterBanner
        ]);
    }
}
