@extends('user::admin.layout.app')
@section('title', 'Role Edit')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">Roles Edit
                            @if (auth()->user()->can('Role List'))
                                <a href="{{ url('permission/admin/roles') }}" class="btn btn-info text-right">Lists</a>
                            @endif
                        </h5>
                        <form action="{{ url('permission/admin/roles') }}/{{ $role->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body table-responsive">
                                <h5 class="card-title">Edit Role </h5>

                                <div class="form-group p-1 m-1">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control mt-1" id=""
                                        value="{{ $role->name }}">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Select Permissions </label>

                                    @if ($permissionGroups->count() > 0)
                                        <div class="row">
                                            @foreach ($permissionGroups as $permissionGroup)
                                                <div class="col-md-4">
                                                    <strong>{{ $permissionGroup->name }}</strong> <br>
                                                    @if ($permissionGroup->permissions->count() > 0)
                                                        @foreach ($permissionGroup->permissions as $permission)
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $permission->id }}"
                                                                @if (in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked @endif>
                                                            {{ $permission->name }} <br>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group p-1 m-1">
                                    <button type="submit" class="btn btn-primary form-control mt-3">Update</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
