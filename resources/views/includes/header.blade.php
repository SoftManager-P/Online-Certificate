<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ministry of Commerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('assets/front/images/favicon.png')}}" />

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/jquery.fancybox.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/pull-push.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/multiselect.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/fontawesome-all.css')}}">
    <link href="{{ URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/regular.css"
        integrity="sha384-zkhEzh7td0PG30vxQk1D9liRKeizzot4eqkJ8gB3/I+mZ1rjgQk+BSt2F6rT2c+I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css"
        integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous"> -->
</head>

<body class="sticky150">

    <header>
        <div class="container-fluid topHead myaccountRow">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-right">
                    @if (Session::get('user') == false)
                        <a href="{{url('login')}}" class="{{ Session::get('nav') =='login' ? 'btn_red':'btn_border'}}">Login</a>
                        <a href="{{url('register')}}" class="{{ Session::get('nav') =='register' ? 'btn_red':'btn_border'}}">Sign up</a>
                    @else
                        <div class="dropdown myaccountBTN">
                            <button type="button" class="myaccount dropdown-toggle" data-toggle="dropdown">
                           
                            {!! Session::get('user')['first_name']!!} {!! Session::get('user')['last_name']!!}
                            </button>
                             <div class="dropdown-menu">
                              <a class="dropdown-item editprofileicon" href="{{url('edit_profile/')}}">Edit Profile</a>
                              <a class="dropdown-item checkdocicon" href="{{url('submitted')}}">Check Documents</a>
                              <a class="dropdown-item logouticon" href="{{url('logout')}}">Log Out</a>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 navCol">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{url('home')}}">
                            <img src="{{ URL::asset('assets/front/images/logo.png')}}" alt="Ministry of Commerce" class="hide_mobile">
                            <img src="{{ URL::asset('assets/front/images/logo_mobile.png')}}" alt="Ministry of Commerce" class="show_mobile">
                        </a>
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item {{ Session::get('nav') =='home' ? 'active':''}}">
                                    <a class="nav-link" href="{{url('')}}">Home</a>
                                </li>
                                <li class="nav-item {{ Session::get('nav') =='services' ? 'active':''}}">
                                    <a class="nav-link" href="{{url('services')}}">Services</a>
                                </li>
                                <li class="nav-item {{ Session::get('nav') =='contact_us' ? 'active':''}}">
                                    <a class="nav-link" href="{{url('contact_us')}}">Contact Us</a>
                                </li>
                                <li class="nav-item {{ Session::get('nav') =='about_us' ? 'active':''}}">
                                    <a class="nav-link" href="{{url('about_us')}}">About us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

