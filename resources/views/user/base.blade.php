@extends('home')
@section('content')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                {{-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Premium <sub>crm</sub></a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">User</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Users</h6> --}}
                </nav>
                </ul>
                </div>

            </div>
            <a type="button" class="btn btn-primary" href="{{ route('user.create') }}"><i class="fas fa-plus" style="font-size: 20px;"></i></a>

            </nav>
            <!-- End Navbar -->

                    <!-- Start content -->
                        @yield('action-content')
                    <!-- END content-page -->

        </main>
@endsection
