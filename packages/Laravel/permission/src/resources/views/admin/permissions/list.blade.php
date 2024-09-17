@extends('user::admin.layout.app')
@section('title', 'Permission lists')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">Permission Lists
                            @if (auth()->user()->can('Permission Create'))
                                <a href="{{ url('permission/admin/permission/create') }}"
                                    class="btn btn-info text-right">Add+</a>
                            @endif
                        </h5>

                        <table class="table table-responsive table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Permission Group</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($permissions->count() > 0)
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                @if (isset($permission->permissionGroup))
                                                    {{ $permission->permissionGroup->name }}
                                                @else
                                                    No Permission Group Assigned
                                                @endif

                                            </td>
                                            <td>
                                                @if (auth()->user()->can('Permission Edit'))
                                                    <a href="{{ url('permission/admin/permission') }}/{{ $permission->id }}"
                                                        class="btn btn-xs btn-warning">E</a>
                                                @endif
                                                @if (auth()->user()->can('Permission Delete'))
                                                    <form
                                                        action="{{ url('permission/admin/permission') }}/{{ $permission->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">D</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $permissions->links() }}
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
