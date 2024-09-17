<?php

namespace Laravel\Permission\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Permission\App\Models\PermissionGroup;
use Laravel\Permission\App\Models\Role;

class UserRolePermissionController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('User Role List') == false) {
            abort(401);
        }
        $users = User::with('roles', 'permissions')->paginate(10);
        return view('permission::admin.user-role-permissions.list', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionGroups = PermissionGroup::with('permissions')->get();
        $roles            = Role::with('permissions')->get();
        $users            = User::get(['id', 'name']);
        return view('permission::admin.user-role-permissions.create', compact('permissionGroups', 'roles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->users) && count($request->users) > 0) {
            foreach ($request->users as $key => $userId) {
                $user   = User::findOrFail($userId);
                if (isset($request->roles) && count($request->roles) > 0) {
                    $user->assignRole($request->roles);
                }
                if (isset($request->permissions) && count($request->permissions) > 0) {
                    $user->givePermissionTo($request->permissions);
                }
            }
        }

        session()->flash('message', 'Selected roles and direct permissions assigned to selected users successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('User Role Edit') == false) {
            abort(401);
        }
        $permissionGroups = PermissionGroup::with('permissions')->get();
        $roles            = Role::with('permissions')->get();
        $user             = User::findOrFail($id);

        return view('permission::admin.user-role-permissions.edit', compact('permissionGroups', 'roles', 'user'));
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
        if (auth()->user()->can('User Role Edit') == false) {
            abort(401);
        }
        $user = User::findOrFail($id);
        if ($user) {
            if (isset($request->roles) && count($request->roles) > 0) {
                $user->syncRoles($request->roles);
            }
            if (isset($request->permissions) && count($request->permissions) > 0) {
                $user->syncPermissions($request->permissions);
            }
        }

        session()->flash('message', 'Selected roles and direct permissions updated to the user!');
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
        if (auth()->user()->can('User Role Delete') == false) {
            abort(401);
        }
        $user         = User::find($id);
        if ($user) {
            $user->syncRoles([]);
            $user->syncPermissions([]);
            session()->flash('message', 'ALl Roles and permissions revoked for the selected user successfully!');
        } else {
            session()->flash('message', 'Permission and roles deletion Failed!');
        }
        return redirect()->back();
    }
}
