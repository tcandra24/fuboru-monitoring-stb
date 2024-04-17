<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Salesman;
use App\Models\SyncSalesman;

class SalesmanController extends Controller
{
    public function index()
    {
        $salesmans = Salesman::paginate(10);

        return Inertia::render('Salesman/Index', [
            'salesmans' => $salesmans
        ]);
    }

    public function create()
    {
        return Inertia::render('Salesman/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|unique:salesman,kode',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
        ]);

        Salesman::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
        ]);

        return redirect()->route('master.salesmans.index');
    }

    public function edit($kode)
    {
        $kode = str_replace('-', '/', $kode);
        $salesman = Salesman::where('kode', $kode)->first();

        return Inertia::render('Salesman/Edit', [
            'salesman' => $salesman,
        ]);
    }

    public function update(Request $request, $kode)
    {
        $kode = str_replace('-', '/', $kode);
        $this->validate($request, [
            'kode' => 'required|unique:salesman,kode,' . $kode . ',kode',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
        ]);

        Salesman::where('kode', $kode)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
        ]);

        return redirect()->route('master.salesmans.index');
    }

    public function sync()
    {
        $syncSalesman = SyncSalesman::all();

        $arrayInsert = $syncSalesman->map(function($data){
            return [
                'kode' => $data->KodeID,
                'nama' => $data->Nama,
                'alamat' => '-',
                'kota' => '-',
            ];
        });
        // foreach($syncSalesman as $sales){
        //     // Salesman::updateOrCreate(
        //     //     [
        //     //         'kode' => $sales->KodeID,
        //     //     ],
        //     //     [
        //     //         'nama' => $sales->Nama,
        //     //         'alamat' => '-',
        //     //         'kota' => '-',
        //     //     ]
        //     // );
        //     array_push($arrayInsert, [
        //         'kode' => $sales->KodeID,
        //         'nama' => $sales->Nama,
        //         'alamat' => '-',
        //         'kota' => '-',
        //     ]);
        // }

        Salesman::upsert($arrayInsert, ['kode'], [
            'nama',
            'alamat',
            'kota',
        ]);


        return redirect()->route('master.salesmans.index');
    }
}
