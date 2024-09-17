@extends('user::admin.layout.app')
@section('title', 'Permission group create')
@section('content')
    <section class="section">
        @include('user::admin.layout.message')
        <div class="row">
            <div class="col-lg-12">
                <h5 class="card-title">Permission-Group
                    @if (auth()->user()->can('Permission Groups List'))
                        <a href="{{ url('permission/admin/permissions-groups') }}" class="btn btn-info text-right">Lists</a>
                    @endif
                </h5>
                <div class="card p-2">
                    <form class="forms-sample" action="{{ url('permission/admin/permissions-groups') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="name"
                                placeholder="Name">
                        </div>
                        {{-- <div class="row">
                            @if (count($data['permission']) > 0)
                                @foreach ($data['permission'] as $permissionGroup)
                                    <div class="col-md-4">
                                        <p><strong>{{ $permissionGroup->name }}</strong></p>
                                        @if (count($permissionGroup->permissions) > 0)
                                            @foreach ($permissionGroup->permissions as $permission)
                                                <input type="checkbox" class="form-check-input" name="permission_ids[]"
                                                    value="{{ $permission->id }}">
                                                {{ $permission->name }} <br>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div> --}}
                        <br>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ url('permissions-groups') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script></script>
@endpush
