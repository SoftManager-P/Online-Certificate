<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <section class="ptb40 darkSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 p_col offset-lg-2">
                    <div class="payfeesSection">
                        <div class="payfeesRow submittedRow">

                            <div class="payfeesheader">
                                <h6>Submitted documents</h6>
                                <p>(Check status of submitted documents)</p>
                            </div>
                            <div class="seachbox">
                                <div class="searchWidth"><input type="text" class="cardinput search"
                                        placeholder="Search by name. Tag" id="search" onchange="search_submitted()">
                                </div>
                                <!-- <div class="filterbtn"><img src="<?php echo e(URL::asset('assets/front/images/filter.svg')); ?>"></div> -->
                            </div>
                        </div>

                        <div class="submittedDocTable">

                            <table class="rwd-table">
                                <tr>
                                    <th>Sectors</th>
                                    <th>Services</th>
                                    <th>Time </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <?php $__currentLoopData = $evlauate_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="">
                                    <td data-th="Sectors">
                                        <div class="sectorsBox">
                                            <a href="<?php echo e(url('document_detail')); ?>/<?php echo e($item->id); ?>" target="_blank"><div class="sectors1"><img src="<?php echo e(URL::asset('assets/front/images/pdfdownloadsmall.png')); ?> "style="width: 80px; height: 50px;" ></div></a>
                                            <div class="sectors2">

                                                <h2><?php echo e($item->sector_name); ?></h2>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Services">
                                        <?php if($item->cert_type == 'product'): ?>
                                        <span>All My Products </span>
                                        <?php else: ?>
                                        <?php $__currentLoopData = $item->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="tagSector"><?php echo e($sitem); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    
                                    </td>
                                    <td data-th="Time">
                                        <div class="sectorTime"><?php echo e(date("H:ia",strtotime($item->updated_at))); ?></div>
                                        <div class="sectorDate"><?php echo e(date("m/d/Y",strtotime($item->updated_at))); ?></div>
                                    </td>
                                    <td data-th="Status">
                                        <?php if($item->status == '1'): ?>
                                        <div class="waiting">Waiting for Approval</div>
                                        <?php elseif($item->status == '2'): ?>
                                        <div class="approved">Approved</div>
                                        <?php elseif($item->status == '3'): ?>
                                        <div class="rejected">Rejected</div>
                                        <?php endif; ?>

                                    </td>
                                    <td data-th="print">
                                        <?php if($item->status == '3'): ?>
                                        <button class="btn print"   onclick="detail(<?php echo e($item->id); ?>,'<?php echo e($item->review); ?>')" >Details</button>
                                        <?php else: ?>
                                        <button class="btn print"  onclick="approvedetail(<?php echo e($item->id); ?>,'<?php echo e($item->review); ?>')" <?php echo e($item->status == '2'?'':'disabled'); ?>>Print</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div>

    <form id="print_form" method="POST" action="<?php echo e(url('print_certification')); ?>">
        <?php echo csrf_field(); ?>

        <input type="hidden" id="eval_id" name="eval_id">
    </form>
<!-- </div> -->

<button type="button" class="btn btn-primary waves-effect waves-light" style="display: none;" data-toggle="modal" data-target=".bs-example-modal-center" id="modal_button"></button>
<div class="modal fade bs-example-modal-center descript" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Detail view</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <!-- <form class="" action="<?php echo e(url('resubmit')); ?>" autocomplete="on" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> -->
                <div class="modal-body">
                
                    <input type="hidden" name="his_id" id="update_id">
                    <div class="form-group">
                        <span class="form-group" id="review" style="width:100%">
                            
                        </span>
                    </div>
                   
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" id="resbmit">Change Upload file</button>
                </div>
                <!-- </form> -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
<button type="button" class="btn btn-primary waves-effect waves-light" style="display: none;" data-toggle="modal" data-target=".approved_modal" id="approve_modal_button"></button>
<div class="modal fade bs-example-modal-center approved_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Detail view</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <span class="form-group" id="approvereview" style="width:100%">
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn print"  onclick="print_cert()">Print</button>

                </div>
                <!-- </form> -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>

    // function print_cert(id) {
    //     $('#eval_id').val(id);
    //     $('#print_form').submit(); 
    //     setTimeout (function(){
    //         window.location.href = "<?php echo e(url('submitted')); ?>";
    //     },10000)
    // }

    function detail(id, review) {
        $('#update_id').val(id);
        $('#review').html(review);

        $('#modal_button').click(); 
    }
    function approvedetail(id, approvereview) {
        // $('#update_id').val(id);
        $('#approvereview').html(approvereview);
        $('#approve_modal_button').click(); 
    }
    $('#resbmit').on('click', function(){
        window.location.href = "<?php echo e(url('resubmit')); ?>/"+$('#update_id').val();
        
    })

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

</script>