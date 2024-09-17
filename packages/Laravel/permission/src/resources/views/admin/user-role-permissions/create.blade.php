@extends('user::admin.layout.app')
@section('title', 'User Role/Permissions Assign Create')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">User Role/Permissions Assign
                            @if (auth()->user()->can('User Role List'))
                                <a href="{{ url('permission/admin/users-roles-permissions') }}"
                                    class="btn btn-info text-right">Lists
                                </a>
                            @endif
                        </h5>
                        <form action="{{ url('permission/admin/users-roles-permissions') }}" method="post">
                            @csrf
                            <div class="card-body table-responsive">
                                <h5 class="card-title">User Role/Permissions Assign </h5>
                                <div class="form-group p-1 m-1">
                                    <strong for="name">Select Users </strong>
                                    <select name="users[]" id="" class="form-control" multiple>
                                        <option value="">SELECT USERS</option>
                                        @if ($users->count() > 0)
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                                <div class="form-group p-1 m-1">
                                    <strong for="name">Select Roles </strong>

                                    @if ($roles->count() > 0)
                                        <div class="row">
                                            @foreach ($roles as $role)
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}">
                                                    <strong>{{ $role->name }}</strong> <br>

                                                    @if ($role->permissions->count() > 0)
                                                        @foreach ($role->permissions as $permission)
                                                            <small>{{ $permission->name }}</small> ,
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group p-1 m-1">
                                    <strong for="name">Select Permissions </strong>

                                    @if ($permissionGroups->count() > 0)
                                        <div class="row">
                                            @foreach ($permissionGroups as $permissionGroup)
                                                <div class="col-md-4">
                                                    <strong>{{ $permissionGroup->name }}</strong> <br>
                                                    @if ($permissionGroup->permissions->count() > 0)
                                                        @foreach ($permissionGroup->permissions as $permission)
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $permission->name }}"> {{ $permission->name }}
                                                            <br>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group p-1 m-1">
                                    <button type="submit" class="btn btn-primary form-control mt-3">Create</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
