<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->withCount('users')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('-', $perm->name)[1] ?? $perm->name;
        });
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        if ($request->permissions) {
            $role->syncPermissions(Permission::whereIn('id', $request->permissions)->get());
        }

        return redirect('/cms/roles')->with('success', 'Level berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('-', $perm->name)[1] ?? $perm->name;
        });
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'Super Admin') {
            return back()->with('error', 'Super Admin tidak dapat diedit.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions(Permission::whereIn('id', $request->permissions)->get());
        } else {
            $role->syncPermissions([]);
        }

        return redirect('/cms/roles')->with('success', 'Level berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'Super Admin') {
            return back()->with('error', 'Super Admin tidak dapat dihapus.');
        }

        DB::table('model_has_roles')->where('role_id', $id)->delete();
        $role->delete();

        return redirect('/cms/roles')->with('success', 'Level berhasil dihapus.');
    }
}
