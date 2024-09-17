<?php

namespace Laravel\Permission\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Laravel\Permission\App\Models\Role;
use Laravel\Permission\App\Models\Permission;
use Laravel\Permission\App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionGroupController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('Permission Groups List')) {
            $permission_groups = PermissionGroup::with('permissions')->orderBy('id', 'desc')->paginate(5);
            return view('permission::admin.permission-groups.list', compact('permission_groups'));
        } else {
            abort(403);
        }
    }

    public function create()
    {
        if (auth()->user()->can('Permission Groups Create') == false) {
            abort(401);
        }
        $permissions = PermissionGroup::with('permissions')->orderby('name')->get();
        $data        = ['permission' => $permissions];
        return view('permission::admin.permission-groups.create')->with('data', $data);
    }

    public function store(Request $request)
    {
        if (auth()->user()->can('Permission Groups Create') == false) {
            abort(401);
        }
        $permission_group                   = new PermissionGroup;
        $permission_group->name             = $request->name;
        // $permission_group->permission_ids   = $request->permission_ids;
        $permission_group->created_by       = Auth::id();
        $permission_group->updated_by       = Auth::id();
        if ($permission_group->save()) {

            session()->flash('message', 'Permission Group created successfully!');
        } else {
            session()->flash('message', 'Permission Group create Failed!');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        if (auth()->user()->can('Permission Groups Edit') == false) {
            abort(401);
        }
        $permission_group = PermissionGroup::find($id);
        $permission_ids   = Permission::where('id', $permission_group->permission_ids)->pluck('id')->toArray();
        $permissions      = Permission::orderby('name')->get();
        $data        = ['permission_group' => $permission_group, 'permission_ids' => $permission_ids, 'permission' => $permissions];
        return view('permission::admin.permission-groups.edit', compact('permission_group', 'permission_ids', 'permissions'))->with('data', $data);
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->can('Permission Groups Edit') == false) {
            abort(401);
        }
        $permission_group                   = PermissionGroup::find($id);
        $permission_group->name             = $request->name;
        $permission_group->permission_ids   = $request->permission_ids;
        if ($permission_group->save()) {
            session()->flash('message', 'Permission Group updated successfully!');
        } else {
            session()->flash('message', 'Permission Group update Failed!');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if (auth()->user()->can('Permission Groups Delete') == false) {
            abort(401);
        }
        $permission_group         = PermissionGroup::find($id);
        if ($permission_group->delete()) {
            session()->flash('message', 'Permission Group deleted successfully!');
        } else {
            session()->flash('message', 'Permission Group deletion Failed!');
        }
        return redirect()->back();
    }
}
