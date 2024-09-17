@extends('user::admin.layout.app')
@section('title', 'Users lists')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">Users List
                            @if (auth()->user()->can('User Create'))
                                <a href="{{ url('user/admin/user/create') }}" class="btn btn-info text-right">Add +</a>
                            @endif
                        </h5>

                        <table class="table table-responsive table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if (count($user->roles) > 0)
                                                    @foreach ($user->roles as $role)
                                                        {{ $role->name }},
                                                    @endforeach
                                                @else
                                                    No Role Assigned
                                                @endif
                                            </td>
                                            <td>
                                                @if (auth()->user()->can('User Edit'))
                                                    <a href="{{ url('user/admin/user') }}/{{ $user->id }}"
                                                        class="btn btn-xs btn-warning">E</a>
                                                @endif
                                                @if (auth()->user()->can('User Delete'))
                                                    <form action="{{ url('user/admin/user') }}/{{ $user->id }}"
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
