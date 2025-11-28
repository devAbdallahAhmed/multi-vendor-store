@include('admin.patrical.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets-back') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('admin.patrical.navbar')

        <x-nav />
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('breadcrumb')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb float-sm-right mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active text-dark" aria-current="page">@yield('breadcrumb')
                                    </li>
                                </ol>
                            </nav>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- /.content-header -->

            <main role="main" class="main-content">

                @yield('content')
            </main> <!-- main --> <!-- /.content-wrapper -->

            @include('admin.patrical.footer')
            {{-- Scripts --}}
            @include('admin.patrical.script')
