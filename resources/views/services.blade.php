@include('includes.header')
	<section class="ptb60 darkSection minHeightFull">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<h4 class="h4 mb-4">Submit Required documents</h4>
					<p>(Test report, Label, Letter of composition, Certificates)</p>
					<br>
					<form class="formStyle" action="{{url('insert_service')}}"method="POST" enctype="multipart/form-data">
                    @csrf
                 
						<div class="form-group">
							<label>Select Sector</label>
							<select class="fildStyle " name="sector_id" id="sector">
                                @foreach($sector as $key=>$item)
                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                @endforeach
                            </select>
						</div>
						<div class="form-group" >
							<input type="text" class="fildStyle  col-md-9" id="detail_name" placeholder="New Detail">
							
							<button type="button" class="fildStyle btn col-md-2" onclick="add_detail()" style="margin-left:20px">Add</button>
						</div>
						<div class="file-field">
							@foreach($detail as $key =>$item)
								<div class="form-group col-md-12 row">
									<div class="choseFileFiled col-md-8">
										<label class="lebelBtn">{{$item->service_detail}}</label>
									</div>
									
									<div class="col-md-4" style="padding:20px; " >
										<a href="javascript:delete_product_detail({{$item->id}})"><img src="{{ URL::asset('assets/front/images/delete.png')}}" style="width: 35px; height: 35px;"></a>
									</div>
								</div>
							@endforeach
						</div>
						
						<!-- <div class="form-group">
							<button type="Submit" class="btn"><strong>Pay $50</strong> and Submit</button>-->
							<!-- <a href="{{url('pay-fees')}}" class="btn"><strong>Pay $50</strong> and Submit</a> -->
						<!-- </div>  -->
					</form>
				</div>
			</div>
			<a href="{{url('service_list')}}" style="float:right"><button type="button" class="btn btn-primary" >Service List</button></a>
		</div>
	</section>
	
@include('includes.footer')
<form class="deletform" action="{{url('delete_service_detail')}}"method="POST" enctype="multipart/form-data">
    @csrf
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
 //                url: "{{url('get_services')}}",
 //                data : {
 //                    sector_id: $("#sector").val(),
 //                },
 //                 headers: {
 //                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
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

		if($("#detail_name").val()==''){

		}else{
			$.ajax({
	            type : "POST",
	            url: "{{url('insert_service_details')}}",
	            data : {
	            	sector: $("#sector").val(),
	               	detail: $("#detail_name").val(),
	            },
	             headers: {
	                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
	                    },
	            success : function(data) {
            	var detail_id = JSON.parse(data);
            	if (detail_id =='error'){
            		Swal.fire('This Product Detail is already exist!');
            	}else{
            	var detail_name = $("#detail_name").val();
            	$('.file-field').append('<div class="form-group col-md-12 row">\n' +

											'\t\t\t\t\t\t\t\t<div class="choseFileFiled col-md-8">\n' +
											'\t\t\t\t\t\t\t\t\t	<label class="lebelBtn">'+$("#detail_name").val()+'</label>\n' +
											'\t\t\t\t\t\t\t\t\t	</div>\n' +
											
											'\t\t\t\t\t\t\t\t\t	<div class="col-md-4 ; " style="padding:20px; " >\n' +
											'\t\t\t\t\t\t\t\t\t		<a href="javascript:delete_product_detail('+detail_id+')"><img src="{{ URL::asset('assets/front/images/delete.png')}}" style="width: 35px; height: 35px;"></a>\n' +
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
    <!-- // <script src="{{ URL::asset('assets/front/js/multiselect.js')}}"></script> -->
