<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Division;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::paginate(10);

        return Inertia::render('Division/Index', [
            'divisions' => $divisions
        ]);
    }

    public function create()
    {
        return Inertia::render('Division/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|unique:divisi,kode',
            'nama' => 'required',
        ]);

        Division::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('master.divisions.index');
    }

    public function edit($kode)
    {
        $kode = str_replace('-', '/', $kode);
        $division = Division::where('kode', $kode)->first();

        return Inertia::render('Division/Edit', [
            'division' => $division,
        ]);
    }

    public function update(Request $request, $kode)
    {
        $kode = str_replace('-', '/', $kode);
        $this->validate($request, [
            'kode' => 'required|unique:divisi,kode,' . $kode . ',kode',
            'nama' => 'required',
        ]);

        Division::where('kode', $kode)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('master.divisions.index');
    }
}
