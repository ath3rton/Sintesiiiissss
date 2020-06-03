<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ESCIN') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/pre.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo/escinlogo.png') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
@extends('preloader')
    <div class="d-flex tot" id="wrapper app">
        <!-- Sidebar -->
        @if (session()->has('user'))
            @if (in_array(session()->get('user')->rol,array(1,2,3)) )
                <div class="bpcolor border-right" id="sidebar-wrapper">
                <div class="sidebar-heading scolor text-center">{{__('messages.controlpanel')}} </div>
                <hr class="borderscolor">
                @if (session()->get('user')->rol==1)
                    <div class="list-group list-group-flush">
                        <a href="{{ route('validate') }}" class="list-group-item list-group-item-action text-white bpcolor">{{ __('messages.projvalid') }}</a>          
                    </div>
                @elseif (session()->get('user')->rol==2)
                    <div class="list-group list-group-flush">
                        <a href="{{ route('projcreate') }}" class="list-group-item list-group-item-action text-white bpcolor">{{ __('messages.createproj') }}</a>
                        <a href="{{ route('empcreate')}}" class="list-group-item list-group-item-action text-white bpcolor">{{ __('messages.createemp') }}</a> 
                        <a href="{{ route('projmod') }}" class="list-group-item list-group-item-action text-white bpcolor">{{ __('messages.myprojects') }}</a>        
                        <a href="{{ route('myemps') }}" class="list-group-item list-group-item-action text-white bpcolor">{{ __('messages.myemps') }}</a>        
                        
                    </div>
                @elseif(session()->get('user')->rol==3)
                    <div class="list-group list-group-flush">
                        <a href="{{ route('claim') }}" class="list-group-item list-group-item-action text-white bpcolor">{{ __('messages.claim') }}</a>
                    </div>
                @endif
                </div>
            @endif
        @endif
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="navbar-toggler filelogo" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=" navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="container">
                        <a class="navbar-brand nlogo" href="{{ url('/') }}">
                            €$CIN
                        </a>
                        <button class="navbar-toggler filelogo" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if (session()->get('user')==null)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('log') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('log'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('log') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <h5 id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ session()->get('uinf')->nickname }} <span class="caret"></span>
                                            </h5>
                                                
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                        <li class="nav-item  nav-link ml-2 float-left">
                                            <a  href="/locale/es" class="nav-link"><img width="15px"height="11px" src="{{ asset('images/logo/spain.png') }}"></a>
                                        </li>
                                        <li class="nav-item  nav-link ml-2 float-left">
                                            <a href="/locale/en" class="nav-link"><img width="15px"height="11px" src="{{ asset('images/logo/english.png') }}"></a>
                                        </li>
                                    @endif
                                    
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="py-4 container-fluid">
            
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('js/pre.js')}}"></script>
</body>

</html>
