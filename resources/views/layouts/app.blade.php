<!doctype html>
<html lang="en">
 <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>


  <script>
    $(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
  </script>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="{{url('css/css_home.css') }}">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
 
 <link rel="icon" href="{{url('images/denr-logo.png') }}"/>@yield('page-title')
<!--sweetalert-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

 <!--Bootstrap icons-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- CoreUI CSS -->
<link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">



<link href="{{ url('css/FFolders-master/css/ffolders.min.css')}} " rel="stylesheet">

<!--Leaflet CSS-->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

   <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
 integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
 crossorigin=""></script>

 <title>{{ config('app.name', 'Laravel') }}</title>

    <style type="text/css">
     .no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 99999;
	background: url('/images/60162a956d540355329855.gif') center no-repeat #fff;
}
    </style>


 </head>
 <body class="c-app" >
    <div class="se-pre-con"></div>
    
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

        <div style="margin-left: -50px" class="c-sidebar-brand d-md-down-none">
            <img style="height: 50px; width: 50px; margin-right: 8px" src="{{ url('/images/denr-logo.png') }}" alt="">
            {{ config('app.name', 'Laravel') }}
        </div>
        <ul class="c-sidebar-nav ">


            @if(auth()->user()->is_admin == 1)

        <li class="c-sidebar-nav-item">
            @if( Auth::user()->file != null)
                <img style="height: 100px; width: 100px; border-radius: 50%; margin-left: 70px; margin-top: 10px" src="{{ url('storage/'. Auth::user()->file ) }}" class="rounded-circle">
            @else
                <img style="height: 100px; width: 100px; border-radius: 50%; margin-left: 70px; margin-top: 10px" src="{{ url('/images/profile.png') }}" class="rounded-circle">
            @endif
            
        </li>
        <li class="c-sidebar-nav-title">{!! Auth::user()->name !!}</li>
        <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{url('admin/home')}}"><i style="color: #008B8B" class="fa fa-dashboard"></i>&nbsp;&nbsp;&nbsp;
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link" href="{{ url('/applicants')}} ">
                        <i style="color: darkseagreen" class="fa fa-address-card"></i>&nbsp;&nbsp;&nbsp; Applicants
                    </a>
        </li>
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i style="color: coral" class="fa fa-file-text"></i>&nbsp;&nbsp;&nbsp; Transactions
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('CDStransactions') }}"> CDS Transactions </a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('EMStransactions') }}"> EMS Transactions</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('RPStransactions') }}"> RPS Transactions</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('map') }}"> Map</a></li>
            </ul>
        </li>
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="{{ url('/releaseDocs') }}">
                <i style="color:yellow" class="fa fa-folder"></i>&nbsp;&nbsp;&nbsp; Documents
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/releaseDocs') }}"> Release Documents</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/receiveDocs') }}"> Receive Documents</a></li>
            </ul>
        </li>



        <li class="c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link" href="{{ url('users_table') }}">
                <i style="color: rgb(3, 128, 3)" class="fa fa-users"></i>&nbsp;&nbsp;&nbsp; Users
            </a>
        </li>

        <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('reports')}}">
                <i style="color: rgb(248, 39, 39)" class="fa fa-line-chart"></i>&nbsp;&nbsp;&nbsp; Reports
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{url('/appointments')}}"><i style="color: cyan" class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;
                    Appointments
                </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{url('/utilities')}}"><i style="color: rgb(14, 136, 89)" class="fa fa-cogs"></i>&nbsp;&nbsp;&nbsp;
                    Utilities
                </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{url('/guides')}}"><i style="color: rgb(136, 14, 51)" class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;
                    Guides
                </a>
        </li>

            @else


            <li class="c-sidebar-nav-item">
                @if( Auth::user()->file != null)
                <img style="height: 100px; width: 100px; border-radius: 50%; margin-left: 70px; margin-top: 10px" src="{{ url('storage/'. Auth::user()->file ) }}" class="rounded-circle">
            @else
                <img style="height: 100px; width: 100px; border-radius: 50%; margin-left: 70px; margin-top: 10px" src="{{ url('/images/profile.png') }}" class="rounded-circle">
            @endif
            
            </li>
            <li class="c-sidebar-nav-title">{!! Auth::user()->name !!} -
                @if ( Auth::user()->dept_id ==1)
                    (PLANNING AND SUPPORT UNIT (PSU))
                @elseif ( Auth::user()->dept_id ==2)
                    (Conservation Unit (CU))
                @elseif ( Auth::user()->dept_id ==3)
                    (Development Unit (DU))
                @elseif ( Auth::user()->dept_id ==4)
                    (Patents and Deeds Unit (PDU))
                @elseif ( Auth::user()->dept_id ==5)
                    (Licenses and Permits Unit (LPU))
                @elseif ( Auth::user()->dept_id ==6)
                    (Survey Unit (SU))
                @endif
            </li>
            <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{url('/home')}}"><i style="color: cyan" class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;
                    Home
                </a>
            </li>

            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ url('/applicants')}} ">
                            <i style="color: darkseagreen" class="fa fa-address-card"></i>&nbsp;&nbsp;&nbsp; Applicants
                        </a>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i style="color: coral" class="fa fa-file-text"></i>&nbsp;&nbsp;&nbsp; Transactions
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('CDStransactions') }}"> CDS Transactions </a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('EMStransactions') }}"> EMS Transactions</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('RPStransactions') }}"> RPS Transactions</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('map') }}"> Map</a></li>
                </ul>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i style="color:yellow" class="fa fa-folder"></i>&nbsp;&nbsp;&nbsp; Documents
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/releaseDocs') }}"> Release Documents</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/receiveDocs') }}"> Receive Documents</a></li>
                </ul>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{url('/appointments')}}"><i style="color: cyan" class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;
                        Appointments
                    </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{url('/utilities')}}"><i style="color: rgb(14, 136, 89)" class="fa fa-cogs"></i>&nbsp;&nbsp;&nbsp;
                        Utilities
                    </a>
            </li>



            @endif

        </ul>
    </div>

<div class="c-wrapper">

    <header class="navbar navbar-dark bg-dark">
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <span class="navbar-toggler-icon"></span>
        </button>
       

        <div class="float-right">
            <div class="row">
                <div class="col-5">
                    <div class="dropdown" id="markasread" onclick="markNotificationAsRead()">
                        <button class="btn btn-outline-secondary dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                            <span><i class="fa fa-bell"></i> <span class="badge bg-danger">{{count(auth()->user()->unreadNotifications)}}</span></span>
                        </button>
                        <div >
                            @if(is_array(auth()->user()->unreadNotifications)||is_object(auth()->user()->unreadNotifications))
                            <div class="dropdown-menu dropdown-menu-right" >
                                
                                    @forelse (auth()->user()->unreadNotifications as $notification)
                                       
                                        @include('layouts.notifications.'.Str::snake(class_basename($notification->type)))
                                        
                                    @empty
                                    <a href="#" class="dropdown-item">No notifications for now.</a>
                                    @endforelse
                               
                            @endif
                                </div>
                        </div>
                    </div>
                   
                </div>
                <div class="col-5">
                <div class="">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
        
                    </form>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        {!! Auth::user()->name !!}
                    </button>
                    <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
                        <a  class="dropdown-item" href="{{ route("logout") }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
    </header>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

</div>





 <!-- Optional JavaScript -->
 <!-- Popper.js first, then CoreUI JS -->
 <script src="https://unpkg.com/@popperjs/core@2"></script>

 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
 
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  
<script>
    function markNotificationAsRead(){
        $.get('/markAsReadReq');
    }
</script>
 </body>
</html>



