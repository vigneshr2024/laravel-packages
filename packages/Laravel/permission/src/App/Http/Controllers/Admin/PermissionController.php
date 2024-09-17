<?php

namespace Laravel\Permission\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Permission\App\Models\Role;
use Laravel\Permission\App\Models\Permission;
use Laravel\Permission\App\Models\PermissionGroup;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('Permission List')) {
            $permissions = Permission::with('permissionGroup')->orderBy('id', 'desc')->paginate(5);
            return view('permission::admin.permissions.list', compact('permissions'));
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
        if (auth()->user()->can('Permission Create') == false) {
            abort(401);
        }
        $permissionGroups = PermissionGroup::get(['id', 'name']);
        return view('permission::admin.permissions.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Permission Create') == false) {
            abort(401);
        }
        $request->validate([
            'name' => 'required|unique:categories,name|max:25',
            'permission_group_id' => 'required|unique:categories,name|max:25'
        ]);
        $permission         = new Permission;
        $permission->name   = $request->name;
        $permission->guard_name   = 'web';
        $permission->permission_group_id = $request->permission_group_id;
        if ($permission->save()) {
            session()->flash('message', 'Permission created successfully!');
        } else {
            session()->flash('message', 'Permission create Failed!');
        }
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
        if (auth()->user()->can('Permission Edit') == false) {
            abort(401);
        }
        $permission = Permission::with('permissionGroup')->find($id);
        $permissionGroups = PermissionGroup::get(['id', 'name']);
        return view('permission::admin.permissions.edit', compact('permission', 'permissionGroups'));
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
        if (auth()->user()->can('Permission Edit') == false) {
            abort(401);
        }
        $request->validate([
            'name' => 'required|unique:categories,name|max:25',
            'permission_group_id' => 'required|unique:categories,name|max:25'
        ]);
        $permission         = Permission::find($id);
        $permission->name   = $request->name;
        $permission->permission_group_id = $request->permission_group_id;
        if ($permission->save()) {
            session()->flash('message', 'Permission updated successfully!');
        } else {
            session()->flash('message', 'Permission updation Failed!');
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
        if (auth()->user()->can('Permission Delete') == false) {
            abort(401);
        }
        $permission         = Permission::find($id);
        if ($permission->delete()) {
            session()->flash('message', 'Permission deleted successfully!');
        } else {
            session()->flash('message', 'Permission deletion Failed!');
        }
        return redirect()->back();
    }
}
