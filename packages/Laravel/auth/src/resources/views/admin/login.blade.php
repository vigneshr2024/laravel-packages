<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('') }}" rel="icon">
    <link href="{{ asset('bootstrap/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com')}}" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('bootstrap/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('bootstrap/assets/css/style.css') }}" rel="stylesheet">


</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="/user/admin/dashboard" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('bootstrap/assets/img/logo.ico') }}" alt="">
                                    <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>

                                    <form action="{{ url('auth/admin/login') }}" method="POST" class="row g-3 ">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                                <input type="text" name="email" class="form-control"
                                                    id="yourUsername" required placeholder="Enter Email"
                                                    value="{{ old('email') }}">
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required placeholder="Enter Password">
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="col-12">
                                                    <div class="alert alert-danger alert-dismissible fade show mb-2"
                                                        role="alert">
                                                        {{ $error }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (session()->has('message'))
                                            <div class="alert alert-danger alert-dismissible fade show mb-2"
                                                role="alert">
                                                {{ session('message') }}
                                                {{ session()->forget('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                {{-- Designed by <a href="https://bootstraptechnology.in/">bootstrapTechnology</a> --}}
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('bootstrap/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('bootstrap/assets/js/main.js') }}"></script>

</body>

</html>
