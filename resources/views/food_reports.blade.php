@include('includes.header')
	<section class="ptb60 darkSection minHeightFull">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<h4 class="h4 mb-4">Submit Required documents (Only Food Section)</h4> 
					<p>(Test report, Label, Letter of composition, Certificates)</p>
					<br>
					<form class="formStyle" action="{{url('insert_foodservice_history')}}"method="POST" enctype="multipart/form-data">
                    @csrf
                 		<input type="hidden" id="service_ids" name="service_ids">
						<div class="form-group" >
							<input type="text" class="fildStyle  col-md-9" id="service_name" placeholder="New Service">
							
							<button type="button" class="fildStyle btn col-md-2" onclick="add_service()">Add</button>
						</div>
						<div class="file-field">
							@foreach($service as $key =>$service_item)
								@foreach($service_item['document_url'] as $key1 => $item)
								<div class="form-group col-md-12 row">
									<div class="choseFileFiled col-md-8">
										<!-- <input type="file" name="service_{{$service_item['service_name']->id}}"> -->
										<span class="fileText"><img src="{{ URL::asset('assets/front/images/uploadFile.jpg')}}"> {{$service_item['service_name']->name}} sevice file</span>
										<!-- <label class="lebelBtn">Select file</label> -->
									</div>
									<div class="col-md-2"  style="padding:2px; ">
										<a href="{{url('')}}{{$item->document_url}}" target="_blank"><img src="{{ URL::asset('assets/front/images/pdf-icon.png')}}" style="width: 70px; height: 70px;"></a>
									</div>
									<div class="col-md-2 ; " style="padding:20px; " >
										<a href="javascript:update_file({{$item->id}})"><img src="{{ URL::asset('assets/front/images/floppy.png')}}" style="width: 35px; height: 35px;"></a> <a href="javascript:delete_service_his({{$item->id}})"><img src="{{ URL::asset('assets/front/images/delete.png')}}" style="width: 35px; height: 35px;"></a>
									</div>
								</div>
								@endforeach
							@endforeach
							
						</div>
						
						<div class="form-group">
							<button type="Submit" class="btn btn-primary">Save and Udate</button>
							<!-- <button type="Submit" class="btn"><strong>Pay $50</strong> and Submit</button> -->
							<a href="{{url('food_submit')}}" class="btn" style="float:right"><strong>Pay $50</strong> and Submit</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
@include('includes.footer')
<form class="deletform" action="{{url('delete_foodservice')}}"method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="his_id" id="his_id">
</form>

<!-- <form class="updateform" action="{{url('update_service_his')}}"method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="upload_file" id="upload_file">
    <input type="hidden" name="his_id" id="his_id">
</form> -->
<button type="button" class="btn btn-primary waves-effect waves-light" style="display: none;" data-toggle="modal" data-target=".bs-example-modal-center" id="modal_button"></button>
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Upload File</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="" action="{{url('update_service_his')}}" autocomplete="on" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                
                    <input type="hidden" name="his_id" id="update_id">
                    <div class="form-group">
	                    <div class="choseFileFiled">
							<input type="file" name="service_1" accept="application/pdf" required onchange="preview(this);">
							<span class="fileText"><img src="{{ URL::asset('assets/front/images/uploadFile.jpg')}}"> Upload File</span>
							<label class="lebelBtn">Select file</label>
						</div>
					</div>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Save changes</button>

                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script>


$(document).ready(function() {

})
	
	function add_service(){
		if($("#service_name").val()==''){

		}else{
			$.ajax({
            type : "POST",
            url: "{{url('insert_foodservice')}}",
            data : {
               service_name: $("#service_name").val(),
            },
             headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
            success : function(data) {
            	var service_id = JSON.parse(data);
            	$('#service_ids').val($('#service_ids').val()+service_id+',');
            	$('.file-field').append('<div class="form-group">\n' +
			        '\t\t\t\t\t\t\t\t<div class="choseFileFiled">\n' +
			        '\t\t\t\t\t\t\t\t\t<input type="file" accept="application/pdf" required name="service_'+service_id+'" onchange="preview(this);">\n' +
			        '\t\t\t\t\t\t\t\t\t<span class="fileText"><img src=""> Upload '+$("#service_name").val()+' file</span>\n' +
			        '\t\t\t\t\t\t\t\t\t<label class="lebelBtn">Select file</label>\n' +
			        '\t\t\t\t\t\t\t\t</div>\n' +
			        '\t\t\t\t\t\t\t</div>');
                return;
            }
        });
		}
		
	}
	window.preview = function (input) {
        if (input.files && input.files[0]) {
        	$(input.files).each(function () {
        		var s =this.name;
        		$(input).parent().find('.fileText').html(s);
        	})
        }
    };
    function update_file(his_id){
    	$('#update_id').val(his_id);
    	$('#modal_button').click();
    	// $('.updateform').submit();
    }
    function delete_service_his(his_id){
    	$('#his_id').val(his_id);
    	$('.deletform').submit();
  //   	if(his_id != ''){
		// $.ajax({
  //           type : "POST",
  //           url: "{{url('delete_foodservice')}}",
  //           data : {
  //              his_id: his_id,
  //           },
  //            headers: {
  //                       'X-CSRF-TOKEN': "{{ csrf_token() }}",
  //                   },
  //           success : function(data) {
  //           	var service_id = JSON.parse(data);
  //           	$('#service_ids').val($('#service_ids').val()+service_id+',');
  //           	$('.file-field').append('<div class="form-group">\n' +
		// 	        '\t\t\t\t\t\t\t\t<div class="choseFileFiled">\n' +
		// 	        '\t\t\t\t\t\t\t\t\t<input type="file" accept="doc/pdf" required name="service_'+service_id+'" onchange="preview(this);">\n' +
		// 	        '\t\t\t\t\t\t\t\t\t<span class="fileText"><img src=""> Upload '+$("#service_name").val()+' file</span>\n' +
		// 	        '\t\t\t\t\t\t\t\t\t<label class="lebelBtn">Select file</label>\n' +
		// 	        '\t\t\t\t\t\t\t\t</div>\n' +
		// 	        '\t\t\t\t\t\t\t</div>');
  //               return;
  //           }
  //       });
  //   	}
    }
    
	
		
 
</script>
    <script src="{{ URL::asset('assets/front/js/multiselect.js')}}"></script>
