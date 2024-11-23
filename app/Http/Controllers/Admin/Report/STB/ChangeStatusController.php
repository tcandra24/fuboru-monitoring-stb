<?php

namespace App\Http\Controllers\Admin\Report\STB;

use App\Http\Controllers\Controller;
use App\Models\Stb;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($kode_nota)
    {
        $kode_nota = str_replace('-', '/', $kode_nota);

        Stb::where('kodenota', $kode_nota)->update([
            'is_insert' => 1
        ]);

        return redirect()->route('report.stb.index');
    }
}
