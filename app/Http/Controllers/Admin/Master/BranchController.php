<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::paginate(10);

        return Inertia::render('Branch/Index', [
            'branches' => $branches
        ]);
    }

    public function create()
    {
        return Inertia::render('Branch/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|unique:cabang,kode',
            'nama' => 'required',
        ]);

        Branch::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('master.branches.index');
    }

    public function edit($kode)
    {
        $kode = str_replace('-', '/', $kode);
        $branch = Branch::where('kode', $kode)->first();

        return Inertia::render('Branch/Edit', [
            'branch' => $branch,
        ]);
    }

    public function update(Request $request, $kode)
    {
        $kode = str_replace('-', '/', $kode);
        $this->validate($request, [
            'kode' => 'required|unique:cabang,kode,' . $kode . ',kode',
            'nama' => 'required',
        ]);

        Branch::where('kode', $kode)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('master.branches.index');
    }
}
