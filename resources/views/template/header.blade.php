
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Ministry of Commerce</title>
        <link rel="icon" href="{{ URL::asset('assets/front/images/favicon.png')}}">
        <link rel="shortcut icon" type="image/png" href="{{ URL::asset('assets/front/images/favicon.png')}}" />
        <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
        <link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        <link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{ URL::asset('assets/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

        <link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/x-editable/css/bootstrap-editable.css')}}" rel="stylesheet">


<style>
   .header-title {
    font-size: 22px;
}
</style>






        
        
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="{{url('home')}}" class="logo">
                        <span>
                            <img src="{{ URL::asset('assets/front/images/logo.png')}}" alt="" height="40" width="70">
                        </span>
                        
                    </a>
                </div>
      

                <nav class="navbar-custom">

                    <ul class="navbar-right d-flex list-inline float-right mb-0">
                       
                        <li class="dropdown notification-list">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="margin:0px 15px;">
                                    <!-- <img src="{{url('uploads/images/user/img_avatar3.png')}}" alt="user" class="rounded-circle"> -->
                                    <span>{{Session::get('user')['first_name']}}</span> <b>
                                  
                                    @if(Session::get('user')['role'] == "admin") Admin @endif
                                   
                                    @if(Session::get('user')['role'] == "employee") Employee @endif</b>
                                    <i class="ion-ios7-arrow-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                   
                                    @if(Session::get('user')['role'] == "admin") 
                                    
                                    <a class="dropdown-item" href="{{url('admin/myprofile/')}}/{{Session::get('user')['id']}}"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                                   
                                    @endif
                                    

                                    @if(Session::get('user')['role'] == "employee") 
                                    
                                    <a class="dropdown-item" href="{{url('employee/myprofile/')}}/{{Session::get('user')['id']}}"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                                   
                                    @endif
                                    <a class="dropdown-item text-danger" href="{{url('logout')}}"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                </div>                                                                  
                            </div>
                        </li>

                    </ul>
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                   

                </nav>

            </div>
            <!-- Top Bar End -->

