@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="card-title">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endforeach
@endif
@if (session()->has('message'))
    <div class="card-title">
        <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ session('message') }}
            {{ session()->forget('message') }} 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
