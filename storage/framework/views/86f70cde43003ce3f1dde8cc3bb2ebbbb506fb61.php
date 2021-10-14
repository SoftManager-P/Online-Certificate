<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link href="<?php echo e(URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css">
    <section class="ptb40 darkSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12  ">
                <!-- offset-lg-2 -->
                    <div class="payfeesSection">
                        <div class="payfeesRow submittedRow">

                            <div class="payfeesheader">
                                <h6>My Products</h6>
                            </div>
                            <div>
                                <a href="<?php echo e(url('edit_product')); ?>/0"><button class="btn " >New Product</button></a>
                            </div>
                            <div>
                                <button class="btn " style="background-color:#58c358;border-color:#58c358;"  onclick="set_category()" >Set Ctegory</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center-a">Excel Import</button>
                            </div>
                            <div>
                                <a href="<?php echo e(url('submit_product')); ?>"><button class="btn "> Submit</button></a>
                            </div>
                           
                            <!--  <div class="seachbox">
                                <div class="searchWidth"><input type="text" class="cardinput search"
                                        placeholder="Search by name. Tag" id="search" onchange="search_submitted()">
                                </div> -->
                                <!-- <div class="filterbtn"><img src="<?php echo e(URL::asset('assets/front/images/filter.svg')); ?>"></div> -->
                            <!-- </div> -->
                        </div>

                        
                    </div>
                </div>
            </div>
            <div class="row " style="padding-top:20px">

                <table class="rwd-table  dt-responsive table table-hover mb-0" >
                    <thead class="thead-light">
                    <tr>
                        <th>Product Name</th>
                        <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($item->detail_item); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th>Category </th>
                        <th>Docment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody >
                    <?php $__currentLoopData = $product_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $item1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="">
                        
                        <td data-th="Sectors">
                            <div class="sectorsBox">
                            <input type="hidden" class="row_id" value="<?php echo e($item1['id']); ?>">
                            <input type="checkbox" style="margin:10px;width:15px;height:15px;">
                                <div class="sectors2">
                                    <h2><?php echo e($item1['name']); ?></h2>
                                </div>
                            </div>
                        </td>
                        <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 =>$item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td data-th="Sectors">
                            <span class="sectors2"><?php echo e(isset($item1[$item2->id])?$item1[$item2->id]:''); ?></span>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td data-th="Time">
                            <div class="sectorTime"><?php echo e($item1['category_title']); ?></div>
                        </td>
                        <td data-th="Time">
                            <a href="<?php echo e(url('')); ?><?php echo e($item1['document']); ?>" target="_blank"><img src="<?php echo e(URL::asset('assets/front/images/pdfdownload.png')); ?>" style="width: 80px; height: 80px;"></a>
                        </td>
                        <td data-th="print">
                            <a href="<?php echo e(url('edit_product')); ?>/<?php echo e($item1['id']); ?>" style="display:inline-text"><img src="<?php echo e(URL::asset('assets/front/images/save.png')); ?>" style="width: 40px; height: 40px;"></a> 
                            <a href="javascript:delete_product(<?php echo e($item1['id']); ?>)"><img src="<?php echo e(URL::asset('assets/front/images/delete.png')); ?>" style="width: 33px; height: 33px;"></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>


            </div>
        </div>
    </section>
<div>

<form id="print_form" method="POST" action="<?php echo e(url('delete_product')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" id="product_id" name="product_id">
</form>
<!-- </div> -->
<button type="button" class="btn btn-primary waves-effect waves-light" style="display: none;" data-toggle="modal" data-target=".bs-example-modal-center" id="modal_button"></button>
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Set Category</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="" action="<?php echo e(url('set_category')); ?>" autocomplete="on" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="checked_ids" id="ckecked_ids">
                <div class="form-group row" >
                    <label class="col-md-2" style="text-align:right"><h5>Category Name</h5> </label>
                    <input type="text" class="cardinput col-md-7 offset-md-1" name="category" placeholder="category_name" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Save changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-center-a" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Excel Import</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="" action="<?php echo e(url('uploadCsvFile')); ?>" autocomplete="on" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div style="text-align:center"><a href="<?php echo e(url('template_excel')); ?>" ><span >template download</span></a></div>
            <div class="modal-body">
                
                <div class="form-group row" >
                    <label class="col-md-3" style="text-align:right"><h5>Excel File</h5> </label>
                    <input type="file" class="col-md-7 offset-md-1" accept="Excel5/xls" name="excelfile"  required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Save changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="<?php echo e(URL::asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        var $table = $('.rwd-table');
        var datatable = $table.dataTable({
            "ordering": false,
            "info": true,
            "searching": true,
            "lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
            "scrollX": true,
            "scrollCollapse": true,
            "jQueryUI": true,
            "paging": true,
            "pagingType": "full_numbers",
            "pageLength": 20, // default record count per page
            bProcessing: true,
            autoWidth: false,
        });
        $('#DataTables_Table_0_wrapper').attr('style','width:100%');

    })

    function set_category()
    {
        var checkbox = $('[type="checkbox"]');
        var checked_ids = '';
        for (var i = 0; i < checkbox.length; i++) {
            if(checkbox[i].checked == true){
                if(checked_ids=='')
                    checked_ids = $(checkbox[i]).parent().find('.row_id').val();
                else 
                    checked_ids = checked_ids+','+$(checkbox[i]).parent().find('.row_id').val(); 
            }
        };
        if (checked_ids==''){
            Swal.fire('Please check Product Name!')
        }else{
            $('#ckecked_ids').val(checked_ids);
            $('#modal_button').click();
        }
        
    }
    function delete_product(id) {
        Swal.fire({
            title: "Are you sure delete?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#58db83",
            cancelButtonColor: "#ec536c",
            confirmButtonText: "Yes, delete it!"
          }).then(function (result) {
            if (result.value) {
                $('#product_id').val(id);
       
                $('#print_form').submit(); 
            }
        });
        
    }
    
   
    function search_submitted(){
        var search = $('#search').val();

        var table_tr = $('tr');
        for (var i = 1; i < table_tr.length; i++) {
            var $that = $(table_tr[i]);
            var str = '';
            $that.find('.sectors2').each(function() {
                // var s = this;
            str += this.innerText;
            })
            $that.find('.tagSector').each(function() {
            str += this.innerText;
            })
            
            var pos = str.indexOf(search);
            if(pos == -1){
                $that.css('display','none');
            }else{
                $that.css('display','')
            }
            if(search == '')
                {$that.css('display','');}
        }
    }

    var e='<?php echo e(Session::get('error_msg')); ?>';
      if(e !=''){
        Swal.fire(e);
      }
</script>