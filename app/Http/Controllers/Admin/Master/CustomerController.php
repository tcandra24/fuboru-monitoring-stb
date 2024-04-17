<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Customer;
use App\Models\Branch;
use App\Models\Division;
use App\Models\SyncCustomer;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user', 'division', 'branch')->paginate(10);

        return Inertia::render('Customer/Index', [
            'customers' => $customers
        ]);
    }

    public function create()
    {
        $branches = Branch::all();
        $divisions = Division::all();
        return Inertia::render('Customer/Create', [
            'branches' => $branches,
            'divisions' => $divisions,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|unique:pelanggan,kode',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'telepon' => 'required',
            'kode_divisi' => 'required',
            'kode_area' => 'required',
        ]);

        Customer::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'telepon' => $request->telepon,
            'kode_divisi' => $request->kode_divisi,
            'kode_area' => $request->kode_area,
        ]);

        return redirect()->route('master.customers.index');
    }

    public function edit($kode)
    {
        $kode = str_replace('-', '/', $kode);
        $customer = Customer::where('kode', $kode)->first();
        $branches = Branch::all();
        $divisions = Division::all();

        return Inertia::render('Customer/Edit', [
            'customer' => $customer,
            'branches' => $branches,
            'divisions' => $divisions,
        ]);
    }

    public function update(Request $request, $kode)
    {
        $kode = str_replace('-', '/', $kode);
        $this->validate($request, [
            'kode' => 'required|unique:pelanggan,kode,' . $kode . ',kode',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'telepon' => 'required',
            'kode_divisi' => 'required',
            'kode_area' => 'required',
        ]);

        Customer::where('kode', $kode)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'telepon' => $request->telepon,
            'kode_divisi' => $request->kode_divisi,
            'kode_area' => $request->kode_area,
        ]);

        return redirect()->route('master.customers.index');
    }

    public function sync()
    {
        $syncCustomer = SyncCustomer::where('divisi', '<>', '')->get();
        $arrayInsert = $syncCustomer->map(function($data){
            $division = Division::select('kode')->where('nama', 'LIKE', '%'. $data->Divisi .'%')->first();

            return [
                'kode' => $data->KdPlg,
                'nama' => $data->Nama,
                'alamat' => $data->Alamat,
                'kota' => $data->Kota,
                'kode_pos' => '-',
                'kecamatan' => $data->Kec,
                'kelurahan' => '-',
                'telepon' => $data->Telp ?? '-',
                'kode_divisi' => $division ? $division->kode : '-',
            ];
        });
        // foreach($syncCustomer as $customer){
        //     if(!$customer->Divisi){
        //         continue;
        //     }

        //     $divisi = Division::where('nama', 'LIKE', '%' . $customer->Divisi . '%');
        //     if(!$divisi->exists()){
        //         continue;
        //     }
        //     $kodeDivisi = $divisi->first();

        //     // Customer::updateOrCreate(
        //     //     [
        //     //         'kode' => $customer->KdPlg,
        //     //     ],
        //     //     [
        //     //         'nama' => $customer->Nama,
        //     //         'alamat' => $customer->Alamat,
        //     //         'kota' => $customer->Kota,
        //     //         'kode_pos' => '-',
        //     //         'kecamatan' => $customer->Kec,
        //     //         'kelurahan' => '-',
        //     //         'telepon' => $customer->Telp ?? '-',
        //     //         'kode_divisi' => $kodeDivisi->kode,
        //     //     ]
        //     // );

        //     array_push($arrayInsert, [
        //         'kode' => $customer->KdPlg,
        //         'nama' => $customer->Nama,
        //         'alamat' => $customer->Alamat,
        //         'kota' => $customer->Kota,
        //         'kode_pos' => '-',
        //         'kecamatan' => $customer->Kec,
        //         'kelurahan' => '-',
        //         'telepon' => $customer->Telp ?? '-',
        //         'kode_divisi' => $kodeDivisi->kode,
        //     ]);
        // }

        Customer::upsert($arrayInsert, ['kode'], [
            'nama',
            'alamat',
            'kota',
            'kode_pos',
            'kecamatan',
            'kelurahan',
            'telepon',
            'kode_divisi'
        ]);

        return redirect()->route('master.customers.index');
    }
}
