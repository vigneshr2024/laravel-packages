@extends('user::admin.layout.app')
@section('title', 'User Create')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive ">
                        <h5 class="card-title">Users List
                            @if (auth()->user()->can('User List'))
                                <a href="{{ url('user/admin/user') }}" class="btn btn-info text-right">Lists
                                </a>
                            @endif
                        </h5>
                        <form action="{{ url('user/admin/user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body table-responsive">
                                <h5 class="card-title">Create User </h5>

                                <div class="form-group p-1 m-1">
                                    <label for="name">User Name</label>
                                    <input type="text" name="name" class="form-control mt-1" id="" required
                                        placeholder="Enter User Name">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Email </label>
                                    <input type="text" name="email" class="form-control mt-1" id="" required
                                        placeholder="Enter User Email ID">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control mt-1" id="password" required
                                        placeholder="Enter Password">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">First Name</label>
                                    <input type="text" name="first_name" class="form-control mt-1" id="" required
                                        placeholder="Enter First Name">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control mt-1" id="" required
                                        placeholder="Enter Last Name">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Mobile Number</label>
                                    <input type="text" name="mobile_number" class="form-control mt-1" id="" required
                                        placeholder="Enter Mobile Number">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Designation</label>
                                    <input type="text" name="job" class="form-control mt-1" id="" required
                                        placeholder="Enter Your Designation">
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="image">Profile image:</label>
                                    <input type="file" name="profile_image" id="image" class="form-control" required>
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Status</label>
                                    <select name="status" class="form-control" id="" required>
                                        <option value="">SELECT STATUS</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">InActive</option>
                                        <option value="blocked">Blocked</option>
                                    </select>
                                </div>
                                <div class="form-group p-1 m-1">
                                    <label for="name">Select Role </label>
                                    @if ($roles->count() > 0)
                                        <div class="row">
                                            @foreach ($roles as $role)
                                                <div class="col-md-4">
                                                    <p> <input type="checkbox" name="role_ids[]" id=""
                                                            value="{{ $role->id }}">
                                                        {{ $role->name }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group p-1 m-1">
                                <label for="name">Select Permission Group </label>

                                @if ($permissionGroups->count() > 0)
                                    <div class="row">

                                        @foreach ($permissionGroups as $permissionGroup)
                                            <div class="col-md-4">
                                                <h6>{{ $permissionGroup->name }}</h6>
                                                @if (isset($permissionGroup->permissions) && count($permissionGroup->permissions) > 0)
                                                    @foreach ($permissionGroup->permissions as $permission)
                                                        <p> <input type="checkbox" name="permission_ids[]" id=""
                                                                value="{{ $permission->id }}">
                                                            {{ $permission->name }}</p>
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
