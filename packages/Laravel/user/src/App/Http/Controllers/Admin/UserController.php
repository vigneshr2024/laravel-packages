<?php

namespace Laravel\User\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Permission\App\Models\PermissionGroup;
use Laravel\Permission\App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('User List') == false) {
            abort(401);
        }
        $users = User::with('roles')->paginate(20);
        return view('user::admin.user.list', compact('users'));
    }

    public function create()
    {
        if (auth()->user()->can('User Create') == false) {
            abort(401);
        }
        $roles            = Role::get();
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('user::admin.user.create', compact('roles', 'permissionGroups'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->can('User Create') == false) {
            abort(401);
        }
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'status'        => 'required|string',
            'job'           => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'      => 'required|string|min:8',
        ]);
        DB::transaction(function () use ($request) {
            $user                = new User();
            $user->name          = $request->name;
            $user->email         = $request->email;
            $user->first_name    = $request->first_name;
            $user->last_name     = $request->last_name;
            $user->mobile_number = $request->mobile_number;
            $user->status        = $request->status;
            $user->job        = $request->job;
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $originalName = $file->getClientOriginalName();

                $storage = new StorageClient([
                    'projectId' => env('GOOGLE_CLOUD_PROJECT_ID'),
                    'keyFilePath' => base_path('cloudsensai-prod-890d25b6f8d0.json'),
                ]);

                $storage->bucket('cloudsens-cs-001')->upload(fopen($file->getRealPath(), 'r'), [
                    'name' => 'admin-profile/' . $originalName,
                    'metadata' => [
                        'contentType' => $file->getClientMimeType(),
                    ],
                ]);

                $user->profile_image = 'https://storage.googleapis.com/cloudsens-cs-001/admin-profile/' . $originalName;
            }

            $user->password      = Hash::make($request->password);
            $user->save();
            if (isset($request->role_ids) && count($request->role_ids) > 0) {
                $user->roles()->sync($request->role_ids);
            }
            if (isset($request->permission_ids) && count($request->permission_ids) > 0) {
                $user->permissions()->sync($request->permission_ids);
            }
        });
        session()->flash('message', 'User Created Successfully!');
        return redirect()->back();
    }

    public function show($id)
    {
        if (auth()->user()->can('User Edit') == false) {
            abort(401);
        }
        $user = User::findOrFail($id);
        $roles = Role::get();
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('user::admin.user.edit', compact('user', 'roles', 'permissionGroups'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'status'        => 'required|string',
            'job'           => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'      => 'required|string|min:8',
        ]);
        if (auth()->user()->can('User Edit') == false) {
            abort(401);
        }
        DB::transaction(function () use ($request, $id) {
            $user                = User::findOrFail($id);
            $user->name          = $request->name;
            $user->email         = $request->email;
            $user->first_name    = $request->first_name;
            $user->last_name     = $request->last_name;
            $user->mobile_number = $request->mobile_number;
            $user->status        = $request->status;
            $user->job        = $request->job;
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $originalName = $file->getClientOriginalName();

                $storage = new StorageClient([
                    'projectId' => env('GOOGLE_CLOUD_PROJECT_ID'),
                    'keyFilePath' => base_path('cloudsensai-prod-890d25b6f8d0.json'),
                ]);

                $storage->bucket('cloudsens-cs-001')->upload(fopen($file->getRealPath(), 'r'), [
                    'name' => 'admin-profile/' . $originalName,
                    'metadata' => [
                        'contentType' => $file->getClientMimeType(),
                    ],
                ]);

                $user->profile_image = 'https://storage.googleapis.com/cloudsens-cs-001/admin-profile/' . $originalName;
            }
            if ($request->password) {
                $user->password      = Hash::make($request->password);
            }
            $user->save();
            if (isset($request->role_ids) && count($request->role_ids) > 0) {
                $user->roles()->sync($request->role_ids);
            }
            if (isset($request->permission_ids) && count($request->permission_ids) > 0) {
                $user->permissions()->sync($request->permission_ids);
            }
        });
        session()->flash('message', 'User Updaed Successfully!');
        return redirect()->back();
    }

    public function  destroy(Request $request, $id)
    {
        if (auth()->user()->can('User Delete') == false) {
            abort(401);
        }
        $user         = User::find($id);
        if ($user->delete()) {
            session()->flash('message', 'User deleted successfully!');
        } else {
            session()->flash('message', 'User deletion Failed!');
        }
        return redirect()->back();
    }
}
