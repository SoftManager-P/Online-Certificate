<?php echo $__env->make('template.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('template.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                                <h4 class="mt-0 header-title" style="display:inline-block">Edit Customer</h4>
                                <a href="<?php echo e(url('admin/customers')); ?>"><button type="button" class="btn btn-outline-primary waves-effect waves-light"  style="display:inline-block; float:right;"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;  List</button>
                                </a>
                            </div>
                            
                            <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card m-b-20 ">
                                    <div class="card-body">
                                        <form class="" action="<?php echo e(url('admin/insert_user')); ?>" autocomplete="on" method="post" role="form">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="id" value="<?php echo isset($user)? $user[0]->id:''; ?>" />
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >User Role</label>
                                                        <div class="col-sm-7" style="padding:0px">
                                                        <select class="form-control " name="user_role" >
                                                            <option value="customer" selected="selected">Customer</option>
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >First Name</label>
                                                        <input type="text" class="form-control col-sm-7" name="first_name" required placeholder="First Name" value="<?php echo isset($user) ? $user[0]->first_name:old('first_name'); ?>" />
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4 input" >Phone Number</label>
                                                        <input type="number" class="form-control col-sm-7 input" data-parsley-type="number" name="phone" required placeholder="Phone Number" value="<?php echo isset($user)? $user[0]->phone:old('phone'); ?>"/>
                                                    </div>
                                                     <div class="form-group row" >
                                                        <label class="col-sm-4" >Password</label>
                                                        <input type="Password" class="form-control col-sm-7" name="password" placeholder="Password"  <?php echo isset($user) ? '':'required'; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4" >E-Mail</label>
                                                            <input type="email" class="form-control col-sm-7" required
                                                                    parsley-type="email" name="email" placeholder="Enter a valid e-mail" value="<?php echo isset($user)? $user[0]->email:old('email'); ?>"/>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Last Name</label>
                                                        <input type="text" class="form-control col-sm-7" name="last_name" required placeholder="Last Name" value="<?php echo isset($user)? $user[0]->last_name:old('last_name'); ?>"/>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Company Name</label>
                                                        <input type="text" class="form-control col-sm-7" name="company_name" required placeholder="Company Name" value="<?php echo isset($user)? $user[0]->company_name:old('company_name'); ?>"/>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Conform Password</label>
                                                        <input type="Password" class="form-control col-sm-7" name="password_confirmation"  placeholder="Conform Password" <?php echo isset($user) ? '':'required'; ?>>
                                                            <?php if(Session::get('pas_err')): ?>
                                                                <span class="" style="color:red;" >
                                                                    <strong>Recheck your password!</strong>
                                                                </span>
                                                            <?php endif; ?>
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
<?php echo $__env->make('template.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
<script>
  var s='<?php echo e(Session::get('msg')); ?>';
  if(s !=''){
    Swal.fire(s);
  }
  var e='<?php echo e(Session::get('error_msg')); ?>';
  if(e !=''){
    Swal.fire(e);
  }
  
$(document).ready(function() {


        
});



</script>