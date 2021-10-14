<style >
  #sidebar-menu > ul > li > a > span{font-size: 18px}
  
</style>            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                           
                            <?php if(Session::get('user')['role'] == "admin"): ?>  
                            <li class= "<?php echo e(Session::get('nav') =='user' ? 'active':''); ?>">
                                <a  class="waves-effect <?php echo e(Session::get('nav') =='user' ? 'active':''); ?>">
                                    <i class="mdi mdi-account-multiple"></i><span> Manage User <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span>
                                </a>
                                <ul class="submenu">
                                    <li class="<?php echo e(Session::get('nav') =='user' && Session::get('sub_nav') =='employee' ? 'active':''); ?>"><a href="<?php echo e(url('admin/employees')); ?>" >Employees </a></li>
                                    <li class="<?php echo e(Session::get('nav') =='user' && Session::get('sub_nav') =='customer' ? 'active':''); ?>"><a href="<?php echo e(url('admin/customers')); ?>">Customers </a></li>
                                   
                                </ul>
                            </li>

                            <li class= "<?php echo e(Session::get('nav') =='sector' ? 'active':''); ?>">
                                <a href="<?php echo e(url('admin/sector')); ?>" class="waves-effect <?php echo e(Session::get('nav') =='sector' ? 'active':''); ?>">
                                    <i class="mdi mdi-buffer"></i><span> Sectors </span>
                                </a>
                            </li>
                                
                            <!-- <li class= "<?php echo e(Session::get('nav') =='service' ? 'active':''); ?>" >
                            
                                <a href="<?php echo e(url('admin/service')); ?>" class="waves-effect <?php echo e(Session::get('nav') =='service' ? 'active':''); ?>">
                                    <i class="mdi mdi-server"></i><span> Services </span>
                                </a>
                            </li> -->
                            
                           
                            <?php endif; ?>
                            
                            <?php if(Session::get('user')['role'] == "employee"): ?>  
                            <li class= "<?php echo e(Session::get('nav') =='evaluate' ? 'active':''); ?>">>
                                <a href="<?php echo e(url('employee/evaluate')); ?>" class="waves-effect <?php echo e(Session::get('nav') =='evaluate' ? 'active':''); ?>">
                                    <i class="mdi mdi-certificate"></i><span> Evaluate_History </span>
                                </a>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->