@extends('user::admin.layout.app')
@section('title', 'User roles/permissions lists')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">User roles/permissions lists
                            @if (auth()->user()->can('User Role Create'))
                                <a href="{{ url('permission/admin/users-roles-permissions/create') }}"
                                    class="btn btn-info text-right"> Assign
                                    roles/permissions to users
                                    +</a>
                            @endif
                        </h5>

                        <table class="table table-responsive table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Direct Permissions</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->roles->pluck('name') }}</td>
                                            <td>{{ $user->permissions->pluck('name') }}</td>
                                            <td>
                                                @if (auth()->user()->can('User Role Edit'))
                                                    <a href="{{ url('permission/admin/users-roles-permissions') }}/{{ $user->id }}"
                                                        class="btn btn-xs btn-warning">E</a>
                                                @endif
                                                @if (auth()->user()->can('User Role Delete'))
                                                    <form
                                                        action="{{ url('permission/admin/users-roles-permissions') }}/{{ $user->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">D</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $users->links() }}
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
