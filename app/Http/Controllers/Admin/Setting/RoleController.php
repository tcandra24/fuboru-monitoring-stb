<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);

        return Inertia::render('Role/Index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return Inertia::render('Role/Create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        $role = Role::create(['name' => $request->name]);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('setting.roles.index');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::all();
        return Inertia::render('Role/Edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('setting.roles.index');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Role::findOrFail($id);
        $user->delete();
        return redirect()->route('setting.roles.index');
    }
}
