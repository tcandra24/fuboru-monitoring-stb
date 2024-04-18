<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Customer;
use App\Models\Branch;
use App\Models\Division;
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
}
