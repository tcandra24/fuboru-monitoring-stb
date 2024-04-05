<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Customer;
use App\Models\Branch;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles', 'customer', 'branch')->paginate(999);

        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $customers = Customer::all();
        $branches = Branch::all();
        return Inertia::render('User/Create', [
            'roles' => $roles,
            'customers' => $customers,
            'branches' => $branches,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode_pelanggan' => 'nullable|unique:pengguna,kode_pelanggan',
            'kode_area' => 'nullable',
            'email' => 'required|email|unique:pengguna,email',
            'roles' => 'required',
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'kode_pelanggan' => $request->kode_pelanggan,
            'kode_area' => $request->kode_area,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $customers = Customer::all();
        $roles = Role::all();
        $branches = Branch::all();
        return Inertia::render('User/Edit', [
            'user' => $user,
            'customers' => $customers,
            'roles' => $roles,
            'branches' => $branches,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode_pelanggan' => 'nullable|unique:pengguna,kode_pelanggan,' . $user->id,
            'kode_area' => 'nullable',
            'email' => 'required|email|unique:pengguna,email,' . $user->id,
            'roles' => 'required',
            'password' => 'nullable',
        ]);

        $fields = [
            'nama' => $request->nama,
            'kode_pelanggan' => $request->kode_pelanggan,
            'kode_area' => $request->kode_area,
            'email' => $request->email,
        ];

        if($request->password !== '') {
            $fields['password'] = bcrypt($request->password);
        }

        $user->update($fields);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
