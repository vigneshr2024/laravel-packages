@extends('user::layouts.app')
@section('title', 'Email Verification')
@push('livewire-css')
    @livewireStyles
@endpush
@push('livewire-script')
    @livewireScripts
@endpush
@section('header-right')

@endsection
@section('content')
    <div class="section mt-2 text-center">
        <h1>Email Verification</h1>
        <h4>click send mail button to send verification link to your mail </h4>
    </div>
    <div class="section mb-5 p-2">
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <div class="transparent">
                <button type="submit" class="btn btn-primary form-control"
                    onclick="this.innerHTML='Sending Verfication link...';">Send Mail</button>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show mb-2 mt-2" role="alert">
                    {{ session('message') }}
                    {{ session()->forget('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        </form>
    </div>
@endsection
