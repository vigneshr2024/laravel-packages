@extends('user::admin.layout.app')
@section('title', 'Permission Edit')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">Permission
                            @if (auth()->user()->can('Permission List'))
                                <a href="{{ url('permission/admin/permission') }}" class="btn btn-info text-right">Lists</a>
                            @endif
                        </h5>
                        <form action="{{ url('permission/admin/permission') }}/{{ $permission->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body table-responsive">
                                <h5 class="card-title">Edit Permission </h5>

                                <div class="form-group p-1 m-1">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control mt-1" id=""
                                        value="{{ $permission->name }}">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Select Permission Group </label>
                                    <select name="permission_group_id" id="" class="form-control">
                                        <option value="">Select Permission Group</option>
                                        @if ($permissionGroups->count() > 0)
                                            @foreach ($permissionGroups as $permissionGroup)
                                                <option value=" {{ $permissionGroup->id }}"
                                                    @if (isset($permission->permissionGroup) && $permissionGroup->id == $permission->permissionGroup->id) @selected(true) @endif>
                                                    {{ $permissionGroup->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
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
