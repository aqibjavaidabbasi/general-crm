<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get(['id', 'name']);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        $groupedPermissions = [];

        foreach ($permissions as $permission) {
            $resource = substr($permission->name, strpos($permission->name, '_') + 1);
            $groupedPermissions[$resource][] = $permission;
        }

        return view('roles.create')->with('permissions', $groupedPermissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $validatedData = $request->validated();
        $role = Role::create(['name' => $validatedData['name']]);
        $permissions = $validatedData['permissions'];
        $permissionValues = array_keys($permissions);
        if ($role->syncPermissions($permissionValues)) {
            return response()->json(['message' => "Role Created Successfully!"]);
        }

        return response()->json(['message' => "Some Error Occured While Creating Role!"], 500);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (!is_null($role)) {
            $permissions = Permission::all();

            $groupedPermissions = [];

            foreach ($permissions as $permission) {
                $resource = substr($permission->name, strpos($permission->name, '_') + 1);
                $groupedPermissions[$resource][] = $permission;
            }
            return view('roles.create', ['permissions' => $groupedPermissions, 'role' => $role]);
        }

        return response()->json(['message' => "User Not Found"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validatedData = $request->validated();
        $role->update(['name' => $validatedData['name']]);
        $permissions = $validatedData['permissions'];
        $permissionValues = array_keys($permissions);
        if ($role->syncPermissions($permissionValues)) {
            return response()->json(['message' => "Role Updated Successfully!"]);
        }
        return response()->json(['message' => "Some Error Occurred While Updating Role!"], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if (!is_null($role)) {
            if ($role->delete()) {
                return response()->json(['message' => "Role Deleted Successfully"], 200);
            }
        }

        return response()->json(['message' => "Role Not Found"], 404);
    }

    public function massDeleteRoles(Request $request)
    {
        $ids = $request->ids;
        $roles = Role::findOrFail($ids);

        foreach ($roles as $role) {
            $role->delete();
        }
        return response()->json(['message' => "Deleted Successfully"]);
    }
}
