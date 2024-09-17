<?php

namespace Laravel\Permission\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use Laravel\Permission\App\Models\Role;
use Laravel\Permission\App\Models\Permission;
use Laravel\Permission\App\Models\PermissionGroup;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('Role List')) {
            $roles = Role::with('permissions')->orderBy('id', 'desc')->paginate(5);
            return view('permission::admin.roles.list', compact('roles'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Role Create') == false) {
            abort(401);
        }
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('permission::admin.roles.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Role Create') == false) {
            abort(401);
        }
        $request->validate([
            'name' => 'required|unique:roles'
        ]);
        $role         = new Role;
        $role->name   = $request->name;
        if ($role->save()) {
            if (isset($request->permissions)) {
                if (count($request->permissions) > 0) {
                    $permissions = Permission::whereIn('id', $request->permissions)
                        ->pluck('name')
                        ->toArray();
                    $role->syncPermissions($permissions);
                }
            }
            session()->flash('message', 'Role created successfully!');
        } else {
            session()->flash('message', 'Role create Failed!');
        }
        return redirect('permission/admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('Role Edit') == false) {
            abort(401);
        }
        $role = Role::find($id);
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('permission::admin.roles.edit', compact('role', 'permissionGroups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('Role Edit') == false) {
            abort(401);
        }
        $role         = Role::find($id);
        $role->name   = $request->name;
        if ($role->save()) {
            if (isset($request->permissions)) {
                if (count($request->permissions) > 0) {
                    $permissions = Permission::whereIn('id', $request->permissions)
                        ->pluck('name')
                        ->toArray();
                    $role->syncPermissions($permissions);
                }
            }
            session()->flash('message', 'Role updated successfully!');
        } else {
            session()->flash('message', 'Role update Failed!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (auth()->user()->can('Role Delete') == false) {
            abort(401);
        }
        $role         = Role::find($id);
        if ($role->delete()) {
            session()->flash('message', 'Role deleted successfully!');
        } else {
            session()->flash('message', 'Role deletion Failed!');
        }
        return redirect()->back();
    }
}
