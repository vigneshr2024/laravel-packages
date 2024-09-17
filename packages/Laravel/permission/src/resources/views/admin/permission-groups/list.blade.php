@extends('user::admin.layout.app')
@section('title', 'Permission groups list')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Permission Group Lists
                            @if (auth()->user()->can('Permission Groups Create'))
                                <a href="{{ url('permission/admin/permissions-groups/create') }}"
                                    class="btn btn-info text-right">Add+</a>
                            @endif
                        </h5>
                        <table class="table table-responsive table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($permission_groups->count() > 0)
                                    @foreach ($permission_groups as $group)
                                        <tr>
                                            <td>{{ $group->id }}</td>
                                            <td>{{ $group->name }}</td>
                                            <td>
                                                @if ($group->permissions->count() > 0)
                                                    {{ implode(',', $group->permissions->pluck('name')->toArray()) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (auth()->user()->can('Permission Groups Edit'))
                                                    <a href="{{ url('permission/admin/permissions-groups/') }}/{{ $group->id }}"
                                                        class="btn btn-xs btn-warning">E</a>
                                                @endif
                                                @if (auth()->user()->can('Permission Groups Delete'))
                                                    <form
                                                        action="{{ url('permission/admin/permissions-groups') }}/{{ $group->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">D</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $permission_groups->links() }}
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
