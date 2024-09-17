@extends('user::admin.layout.app')
@section('title', 'Permission-Group Edit')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">Permission-Group
                            @if (auth()->user()->can('Permission Groups List'))
                                <a
                                    href="{{ url('permission/admin/permissions-groups') }}"class="btn btn-info text-right">Lists</a>
                            @endif
                        </h5>
                        <form action="{{ url('permission/admin/permissions-groups') }}/{{ $permission_group->id }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body table-responsive">
                                <h5 class="card-title">Edit Permission-Group </h5>

                                <div class="form-group p-1 m-1">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control mt-1" id=""
                                        value="{{ $permission_group->name }}">
                                </div>
                                {{-- <div class="form-group p-1 m-1">
                                    <label for="name">Select Permission </label>
                                    <select name="permission_group_id" id="" class="form-control" multiple>
                                        <option value="">Select Permission</option>
                                        @if ($permission_group->permissions->count() > 0)
                                            @foreach ($permissions as $permission)
                                                <option value=" {{ $permission->id }}"
                                                    @if ($permission->id == $permission->id) @selected(true) @endif>
                                                    {{ $permission->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div> --}}


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
