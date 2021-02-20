<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CoreUI CSS -->
 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
 <script type="text/javascript" src="vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js" class="view-script"></script>
 <title>{{ config('app.name', 'Laravel') }}</title>

 
 </head>
 <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    
        <div style="margin-left: -50px" class="c-sidebar-brand d-md-down-none">
            <img style="height: 50px; width: 50px; margin-right: 8px" src="{{ url('/images/denr-logo.png') }}" alt="">
            {{ config('app.name', 'Laravel') }}
        </div>
        <ul class="c-sidebar-nav ">
                
            @include('partials.regmenu')
            @if(auth()->user()->is_admin == 1)
            @include('partials.menu')
            @endif
            
        </ul>
    </div>

<div class="c-wrapper">
    <header class="navbar navbar-light">
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="float-right">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                
            </form>
            <a class="c-sidebar-nav-link" href="{{ route("logout") }}"
                    onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">
                    Logout
                </a>
        </div>
    </header>
    <div class="c-body">
    <main class="c-main">
    <div class="container-fluid">
        @yield('content')
    </div>
    </main>
    </div>
    <footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
    </footer>
    </div>



 <!-- Optional JavaScript -->
 <!-- Popper.js first, then CoreUI JS -->
 <script src="https://unpkg.com/@popperjs/core@2"></script>
 
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
 <script type="text/javascript" src="vendors/@coreui/utils/js/coreui-utils.js" class="view-script"></script>
 
 </body>
</html>
