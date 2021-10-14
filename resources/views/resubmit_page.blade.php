@include('includes.header')
	<section class="ptb60 darkSection minHeightFull">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<h4 class="h4 mb-4">Submit Required documents ({{$eval_his->sector_name}})</h4> 
					<p>(Test report, Label, Letter of composition, Certificates)</p>
					<br>
					<form class="formStyle" action="{{url('insert_foodservice_history')}}"method="POST" enctype="multipart/form-data">
                    @csrf
                 		<input type="hidden" id="service_ids" name="service_ids">
						
						<div class="file-field">
							@foreach($service as $key =>$service_item)
								@foreach($service_item['document_url'] as $key1 => $item)
								<div class="form-group col-md-12 row">
									<div class="choseFileFiled col-md-8">
										<!-- <input type="file" name="service_{{$service_item['service_name']->id}}"> -->
										<span class="fileText"><img src="{{ URL::asset('assets/front/images/uploadFile.jpg')}}"> {{$service_item['service_name']->name}} sevice file</span>
										<!-- <label class="lebelBtn">Select file</label> -->
									</div>
									<div class="col-md-2">
										<a href="{{url('')}}{{$item->document_url}}" target="_blank"><img src="{{ URL::asset('assets/front/images/pdf-icon.png')}}"></a>
									</div>
									<div class="col-md-2">
										<a href="javascript:update_file({{$item->id}})"><h3><img src="{{ URL::asset('assets/front/images/save.png')}}"></h3></a> 
									</div>
								</div>
								@endforeach
							@endforeach
							
						</div>
						
						<div class="form-group">
							<a href="javascript:resub({{$eval_his->id}})" class="btn" style="float:right">ReSubmit</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
@include('includes.footer')
<form class="deletform" action="{{url('update_evaluate_history')}}"method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="his_id" id="his_id">
</form>

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
    }
    function resub(his_id){
    	$('#his_id').val(his_id);
    	$('.deletform').submit();
  
    }
    
	
		
 
</script>
    <script src="{{ URL::asset('assets/front/js/multiselect.js')}}"></script>
