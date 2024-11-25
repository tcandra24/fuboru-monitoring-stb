<?php

namespace App\Http\Controllers\Admin\Report\STB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StbExport;

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
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
            'isInsert' => $request->isInsert,
        ];

        return Excel::download(new StbExport($data), 'stb-export.xlsx');
    }
}
