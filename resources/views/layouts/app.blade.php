<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ticket Management') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <!-- JQuery-Ui CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- datatables css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

    <!-- tokenfield css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css" integrity="sha512-YWDtZYKUekuPMIzojX205b/D7yCj/ZM82P4hkqc9ZctHtQjvq3ei11EvAmqxQoyrIFBd9Uhfn/X6nJ1Nnp+F7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- toastr css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- <link rel="icon" href="https://uilogos.co/img/logomark/towers.png"> -->
<title>Ticket</title>

	
    @yield('head')

    <style>
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body class="hold-transition {{ empty(Auth::user()) ? 'layout-top-nav' : 'sidebar-mini layout-fixed layout-navbar-fixed'  }} ">
    <!-- Site wrapper -->
    <div class="wrapper ">
        @guest
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="" alt="" class="brand-image" style="filter: invert(85%)">
                    <span class="brand-text font-weight-light">Ticket-Management</span>
                </a>
            </div>
        </nav>
        <!-- /.navbar -->
        @else
        <!-- Navbar -->
       @include('admin.includes.nav');
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('admin.includes.sidebar');
        @endguest
        <main class="content-wrapper mt-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
@include('admin.includes.foot')
    <!-- Custom JS -->
    <script>
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    </script>
    @yield('script')
</body>

</html>