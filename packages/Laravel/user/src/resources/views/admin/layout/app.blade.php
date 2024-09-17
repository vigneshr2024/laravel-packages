<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Dashboard </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('bootstrap/assets/img/favicon.ico') }}" rel="icon">
    <link href="{{ asset('bootstrap/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
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

    <link href="{{ asset('bootstrap/assets/css/style.css') }}" rel="stylesheet">
    @yield('page-css')
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/user/admin/dashboard" class="logo d-flex align-items-center">
                <img src="{{ asset('') }}" alt="">
                <span class="d-none d-lg-block">Laravel Packages</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        {{-- @if (auth()->user()->profile_image == null) --}}
                            <img src="{{ asset('/DefaultProfile/default_profile.jpg') }}" alt="Default Image"
                                class="rounded-circle">
                        {{-- @else --}}
                            {{-- <img src="{{ asset(auth()->user()->profile_image) }}" alt="Profile" --}}
                                {{-- class="rounded-circle"> --}}
                        {{-- @endif --}}
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->name }}</h6>
                            <span>{{ auth()->user()->job }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('user/admin/profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('user/admin/profile') }}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{ url('user/admin/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if (auth()->user()->can('Roles and Permission Management Menu'))
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#permissions-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Roles and Permissions Management</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="permissions-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                        @if (auth()->user()->can('Permission Group'))
                            <li>
                                <a href="{{ url('permission/admin/permissions-groups') }}">
                                    <i class="bi bi-circle"></i><span>Permission Group</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Permissions'))
                            <li>
                                <a href="{{ url('permission/admin/permission') }}">
                                    <i class="bi bi-circle"></i><span>permissions</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('Roles'))
                            <li>
                                <a href="{{ url('permission/admin/roles') }}">
                                    <i class="bi bi-circle"></i><span>roles</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('User Role and Direct Permission'))
                            <li>
                                <a href="{{ url('permission/admin/users-roles-permissions') }}">
                                    <i class="bi bi-circle"></i><span>user roles or direct permissions</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('User Management Menu'))
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>User Management</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                        @if (auth()->user()->can('User List'))
                            <li>
                                <a href="{{ url('user/admin/user') }}">
                                    <i class="bi bi-circle"></i><span>list</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('User Create'))
                            <li>
                                <a href="{{ url('user/admin/user/create') }}">
                                    <i class="bi bi-circle"></i><span>create</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Blogs Management Menu'))
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#blogs-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Blogs Management</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="blogs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                        <li>
                            @if (auth()->user()->can('Authors Menu'))
                                <a href="{{ url('blog/admin/author') }}">
                                    <i class="bi bi-circle"></i><span>authors</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Categories Menu'))
                                <a href="{{ url('blog/admin/category') }}">
                                    <i class="bi bi-circle"></i><span>categories</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Industries Menu'))
                                <a href="{{ url('blog/admin/industry') }}">
                                    <i class="bi bi-circle"></i><span>industries</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Tags Menu'))
                                <a href="{{ url('blog/admin/tag') }}">
                                    <i class="bi bi-circle"></i><span>tags</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Social Media Menu'))
                                <a href="{{ url('blog/admin/media') }}">
                                    <i class="bi bi-circle"></i><span>social media</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Forms Menu'))
                                <a href="{{ url('blog/admin/form') }}">
                                    <i class="bi bi-circle"></i><span>forms</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Stacks Menu'))
                                <a href="{{ url('blog/admin/stack') }}">
                                    <i class="bi bi-circle"></i><span>stack</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Posts Management Menu'))
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#posts-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Posts Management</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="posts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                        <li>
                            @if (auth()->user()->can('List Post'))
                                <a href="{{ url('blog/admin/post') }}">
                                    <i class="bi bi-circle"></i><span>list</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Create Post'))
                                <a href="{{ url('blog/admin/post/create') }}">
                                    <i class="bi bi-circle"></i><span>create</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('SEO Management Menu'))
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#seo-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>SEO Management</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="seo-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                        @if (auth()->user()->can('SEO Basic Setting'))
                            <li>
                                <a href="{{ url('blog/admin/seo') }}">
                                    <i class="bi bi-circle"></i><span>SEO Basic Settings</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('Policy Management Menu'))
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#policy-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Policy Management</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="policy-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                        <li>
                            @if (auth()->user()->can('Policies List'))
                                <a href="{{ url('admin/policy') }}">
                                    <i class="bi bi-circle"></i><span>list</span>
                                </a>
                            @endif
                            @if (auth()->user()->can('Policy Create'))
                                <a href="{{ url('admin/policy/create') }}">
                                    <i class="bi bi-circle"></i><span>create</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </li>
            @endif

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('user/admin/profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->



        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Vignesh</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('bootstrap/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('bootstrap/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('bootstrap/assets/js/main.js') }}"></script>
    @yield('page-script')

</body>

</html>
