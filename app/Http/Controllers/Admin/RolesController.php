<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.role.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'admin';
        $role->save();

        return redirect(route('role_list'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $role = Role::findOrFail($id);
        $permissions = Permission::all();


        $role_permissions = $role->permissions->pluck('name')->toArray();

        return view('admin.role.edit', compact('role', 'permissions', 'role_permissions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        if (!empty($request->permission)) {
            $new_permissions = $request->permission;

            $role->permissions()->detach();

            foreach ($new_permissions as $key => $item) {
                $role->givePermissionTo($key);
            }
        }

        return redirect()->route('role_edit',$id)->with( ['update' => 'success'] );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('role_list',$id)->with( ['delete' => 'success'] );

    }
}
