<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Models\Banner;

class BannerExport implements FromView
{
    /**
     * view
     *
     * @return View
     */
    public function view(): View
    {
        $masterBanner = Banner::where('KdPlg', '<>' , '')
            ->get();

        return view('exports.banner', [
            'masterBanner' => $masterBanner
        ]);
    }
}
