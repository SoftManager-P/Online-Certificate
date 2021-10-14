<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<section class="ptb60 darkSection minHeightFull">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<h4 class="h4 mb-4">Submit Required documents</h4>
					<p>(Test report, Label, Letter of composition, Certificates)</p>
					<br>
					<form class="formStyle" action="<?php echo e(url('insert_service')); ?>"method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                 
						<div class="form-group">
							<label>Select Sector</label>
							<select class="fildStyle " name="sector_id" id="sector">
                                <?php $__currentLoopData = $sector; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e((isset($detail[0]) && $detail[0]->sector_id == $item->id)? 'selected':''); ?>><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
						</div>
						<div class="form-group " >
							<input type="text" class="fildStyle  col-md-4" id="detail_name" placeholder="New Detail">
							<input type="text" class="fildStyle  col-md-4" id="detail_name_ara" placeholder="New Detail Arabic" style="margin-left:15px">
							<button type="button" class="fildStyle btn col-md-2" onclick="add_detail()" style="margin-left:20px">Add</button>
						</div>
						<div class="file-field">
							<?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="form-group col-md-12 row">
									<div class="choseFileFiled col-md-4">
										<label class="lebelBtn"><?php echo e($item->service_detail); ?></label>
									</div>
									<div class="choseFileFiled col-md-4" style="margin-left:15px">
										<label class="lebelBtn" ><?php echo e($item->service_detail_ara); ?></label>
									</div>
									<div class="col-md-2" style="padding:20px; " >
										<a href="javascript:delete_product_detail(<?php echo e($item->id); ?>)"><img src="<?php echo e(URL::asset('assets/front/images/delete.png')); ?>" style="width: 35px; height: 35px;"></a>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
						
						<!-- <div class="form-group">
							<button type="Submit" class="btn"><strong>Pay $50</strong> and Submit</button>-->
							<!-- <a href="<?php echo e(url('pay-fees')); ?>" class="btn"><strong>Pay $50</strong> and Submit</a> -->
						<!-- </div>  -->
					</form>
				</div>
			</div>
			<a href="<?php echo e(url('service_list')); ?>" style="float:right"><button type="button" class="btn btn-primary" >Service List</button></a>
		</div>
	</section>
	
<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<form class="deletform" action="<?php echo e(url('delete_service_detail')); ?>"method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="detail_id" id="detail_id">
</form>
<script>


$(document).ready(function() {
	// $("#parent_multi").empty();
	// setService();
})

	// function set(){
	// 	setTimeout (function(){
	// 	deselect_multi();
	// 	var drop = $('.drop-display').find('span');
	// 	for (var i = 0; i < drop.length; i++) {
	// 		var $this = $(drop[i]);

	// 		if($this.hasClass('remove') || $this.hasClass('hide')){
	// 		}else{
	// 			select_multi($this.attr('data-value'));
	// 		};
	// 	};
	// 	$('#service_ids').val(JSON.stringify($('#myMulti').val()));

	// 	},500);
	// };


	// function select_multi(val){
	// 	var multi = $('#myMulti option');
	// 	for (var j = 0; j < multi.length; j++) {
	// 		var $this_option = $(multi[j]);
	// 		if($this_option.attr('value') == val){
	// 			$this_option.attr('selected','selected');
	// 			$('.file-field').append('<div class="form-group">\n' +
 //                    '\t\t\t\t\t\t\t\t<div class="choseFileFiled">\n' +
 //                    '\t\t\t\t\t\t\t\t\t<input type="file" accept="application/pdf" required name="service_'+val+'" onchange="preview(this);">\n' +
 //                    '\t\t\t\t\t\t\t\t\t<span class="fileText"><img src=""> Upload '+$this_option[0].innerText+' file</span>\n' +
 //                    '\t\t\t\t\t\t\t\t\t<label class="lebelBtn">Select file</label>\n' +
 //                    '\t\t\t\t\t\t\t\t</div>\n' +
 //                    '\t\t\t\t\t\t\t</div>');
	// 		}
	// 	};

	// 	var aa = $('[name ^= "service_'+val+'"]');
	// 	var bb = $('[name = "service_'+val+'"]');
	// 	if(aa.length>0){
	// 		$(bb).removeAttr('name');
	// 		$(bb).attr('name','service_'+val+'_'+(aa.length-1)+'');
	// 	}
	// 	return;
	// };
	// function deselect_multi(){
	// 	var multi = $('#myMulti option');
	// 	for (var j = 0; j < multi.length; j++) {
	// 		var $this_option = $(multi[j]);
	// 		$this_option.removeAttr('selected');
	// 	};
	// 	$('.file-field').empty();
	// 	return;
	// };
	    
	// window.preview = function (input) {
 //        if (input.files && input.files[0]) {
 //        	$(input.files).each(function () {
 //        		var s =this.name;
 //        		$(input).parent().find('.fileText').html(s);
 //        	})
 //        }
 //    };
	// $('#sector').on('change',function(){
	// 	setService();
	// 	deselect_multi();
	// })
	// function setService() {
	// 	$("#parent_multi").empty();
 //        if ($("#sector").val() == 0) {
 //            $("#myMulti").html('');
 //        } else {
 //            $.ajax({
 //                type : "POST",
 //                url: "<?php echo e(url('get_services')); ?>",
 //                data : {
 //                    sector_id: $("#sector").val(),
 //                },
 //                 headers: {
 //                            'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
 //                        },
 //                success : function(data) {
 //                	var s = JSON.parse(data);
 //                	$("#parent_multi").append('<select multiple="multiple" id="myMulti" class="multy">');
 //                	for (var i = 0; i < s.length; i++) {
 //                		$("#myMulti").append('<option value="' + s[i]['id'] + '">' + s[i]['name'] + '</option>'); 
 //                	};
 //                    $("#parent_multi").append('</select>');
 //                    setTimeout (function(){
	// 					var myDrop = new drop({
	// 					   selector:  '#myMulti',
	// 					});
	// 				},500);
 //                    return;
 //                }
 //            });
 //        }
 //    }
    
function add_detail(){

		if($("#detail_name").val()==''&& $("#detail_name_ara").val()==''){

		}else{
			$.ajax({
	            type : "POST",
	            url: "<?php echo e(url('insert_service_details')); ?>",
	            data : {
	            	sector: $("#sector").val(),
	               	detail: $("#detail_name").val(),
	               	detail_ara: $("#detail_name_ara").val(),
	            },
	             headers: {
	                        'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
	                    },
	            success : function(data) {
            	var detail_id = JSON.parse(data);
            	if (detail_id =='error'){
            		Swal.fire('This Product Detail is already exist!');
            	}else{
            	var detail_name = $("#detail_name").val();
            	var detail_name_ara = $("#detail_name_ara").val();
            	$('.file-field').append('<div class="form-group col-md-12 row">\n' +

											'\t\t\t\t\t\t\t\t<div class="choseFileFiled col-md-4">\n' +
											'\t\t\t\t\t\t\t\t\t	<label class="lebelBtn">'+$("#detail_name").val()+'</label>\n' +
											'\t\t\t\t\t\t\t\t\t	</div>\n' +
											'\t\t\t\t\t\t\t\t<div class="choseFileFiled col-md-4" style="margin-left:15px">\n' +
											'\t\t\t\t\t\t\t\t\t	<label class="lebelBtn">'+$("#detail_name_ara").val()+'</label>\n' +
											'\t\t\t\t\t\t\t\t\t	</div>\n' +                
											
											'\t\t\t\t\t\t\t\t\t	<div class="col-md-2 ; " style="padding:20px; " >\n' +
											'\t\t\t\t\t\t\t\t\t		<a href="javascript:delete_product_detail('+detail_id+')"><img src="<?php echo e(URL::asset('assets/front/images/delete.png')); ?>" style="width: 35px; height: 35px;"></a>\n' +
											'\t\t\t\t\t\t\t\t\t	</div>\n' +
										'\t\t\t\t\t\t\t\t\t	</div>');

            	}

            }
        });
		}
		
	}
	
    function delete_product_detail(detail_id){
    	Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#58db83",
            cancelButtonColor: "#ec536c",
            confirmButtonText: "Yes, delete it!"
          }).then(function (result) {
            if (result.value) {
                $('#detail_id').val(detail_id);
    	        $('.deletform').submit();
            }
        });

    }	
		
 
</script>
    <!-- // <script src="<?php echo e(URL::asset('assets/front/js/multiselect.js')); ?>"></script> -->
