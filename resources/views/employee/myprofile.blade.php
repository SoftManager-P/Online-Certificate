@include('template.header')
@include('template.sidebar')
<style type="text/css">
  .input{
    display:inline-block;
    /*float: left;*/
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-page">
                <!-- Start content -->
   <div class="content">
        <div class="container-fluid" style="padding-top:15px;">

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="" style="padding:25px;">
                                <h4 class="mt-0 header-title" style="display:inline-block">Edit Myprofile</h4>

                            </div>
                            
                            <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card m-b-20 ">
                                    <div class="card-body">
                                        <form class="" action="{{url('employee/insert_user')}}" autocomplete="on" method="post" role="form">
                                        @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="id" value="{!! isset($user)? $user[0]->id:''  !!}" />
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >User Role</label>
                                                        <div class="col-sm-7" style="padding:0px">
                                                        <select class="form-control " name="user_role" >
                                                            <option value="employee" selected="selected">Employee</option>
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >First Name</label>
                                                        <input type="text" class="form-control col-sm-7" name="first_name" required placeholder="First Name" value="{!! isset($user) ? $user[0]->first_name:old('first_name') !!}" />
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4 input" >Phone Number</label>
                                                        <input type="number" class="form-control col-sm-7 input" data-parsley-type="number" name="phone" required placeholder="Phone Number" value="{!! isset($user)? $user[0]->phone:old('phone') !!}"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4" >E-Mail</label>
                                                            <input type="email" class="form-control col-sm-7" required
                                                                    parsley-type="email" name="email" placeholder="Enter a valid e-mail" value="{!! isset($user)? $user[0]->email:old('email') !!}"/>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Last Name</label>
                                                        <input type="text" class="form-control col-sm-7" name="last_name" required placeholder="Last Name" value="{!! isset($user)? $user[0]->last_name:old('last_name') !!}"/>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Password</label>
                                                        <input type="text" class="form-control col-sm-7" name="password" placeholder="Password" value=""/>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <div style="float:right;">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->

    </div> <!-- content -->

   


<!-- /.content-wrapper -->
@include('template.footer')  
<script>
  var s='{{Session::get('msg')}}';
  if(s !=''){
    Swal.fire(s);
  }
  var e='{{Session::get('error_msg')}}';
  if(e !=''){
    Swal.fire(e);
  }
  
$(document).ready(function() {


        
});



</script>