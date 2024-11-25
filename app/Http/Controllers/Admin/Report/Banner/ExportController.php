<?php

namespace App\Http\Controllers\Admin\Report\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BannerExport;

class ExportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = [
            'customerName' => $request->customerName,
            'city' => $request->city,
        ];

        return Excel::download(new BannerExport($data), 'spanduk-export.xlsx');
    }
}
