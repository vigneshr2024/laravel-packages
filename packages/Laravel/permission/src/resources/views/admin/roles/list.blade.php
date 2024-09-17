@extends('user::admin.layout.app')
@section('title', 'Role lists')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">Role Lists
                            @if (auth()->user()->can('Role Create'))
                                <a href="{{ url('permission/admin/roles/create') }}" class="btn btn-info text-right">Add+</a>
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
                                @if ($roles->count() > 0)
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->permissions->pluck('name') }}</td>
                                            <td>
                                                @if (auth()->user()->can('Role Edit'))
                                                    <a href="{{ url('permission/admin/roles') }}/{{ $role->id }}"
                                                        class="btn btn-xs btn-warning">E</a>
                                                @endif
                                                @if (auth()->user()->can('Role Delete'))
                                                    <form action="{{ url('permission/admin/roles') }}/{{ $role->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">D</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $roles->links() }}
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
