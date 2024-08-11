
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">





    <title>@yield('title')</title>

    {{-- ajax meta token start here --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- ajax meta token start here --}}


    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    {{-- Toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('admin.layouts.includes.style')
</head>

<body>

<!-- ########## START: LEFT PANEL ########## -->
<!-- sl-sideleft -->
@include('admin.layouts.includes.leftsidebar')
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<div class="sl-header">
    <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- sl-header-left -->
    <div class="sl-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name">{{ Auth::user()->name }}</span></span>
                    {{-- <img src="../img/img3.jpg" class="wd-32 rounded-circle" alt="">
                    <img src="{{asset('/')}}admin/assets/img/img9.jpg" alt="..." class="wd-32 rounded-circle"> --}}

                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                        <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
                        <li><a href="" id="logoutButton" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()" ><i class="icon ion-power"></i> Sign Out</a></li>

                        <form id="logoutForm" method="post" action="{{ route('logout') }}">
                            @csrf
                        </form>

                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
        <!-- navicon-right -->
    </div><!-- sl-header-right -->
</div>sl-header
<!-- ########## END: HEAD PANEL ########## -->

<!-- ########## START: RIGHT PANEL ########## -->
<!-- sl-sideright -->
<!-- ########## END: RIGHT PANEL ########## --->

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
{{--        <a class="breadcrumb-item" href="{{ route('home') }}">BlogSite</a>--}}
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody">

        <div>
            @yield('body')
        </div>

    </div><!-- sl-pagebody -->
    {{-- <footer class="sl-footer">
      <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; 2017. Starlight. All Rights Reserved.</div>
        <div>Made by ThemePixels.</div>
      </div>
      <div class="footer-right d-flex align-items-center">
        <span class="tx-uppercase mg-r-10">Share:</span>

      </div>
    </footer> --}}
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->



{{-- playing audio --}}
<audio id="errorAudio" controls preload="none" style="display: none;">
    <source src="{{ asset('audio/error.mp3') }}" type="audio/mpeg">
    <source src="{{ asset('audio/error.ogg') }}" type="audio/ogg">
</audio>
<audio id="successAudio" controls preload="none" style="display: none;">
    <source src="{{ asset('audio/success.mp3') }}" type="audio/mpeg">
    <source src="{{ asset('audio/success.ogg') }}" type="audio/ogg">
</audio>

@include('admin.layouts.includes.scripts')
</body>
</html>
