@include('includes.header')
	<section class="ptb60 darkSection minHeightFull">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<h4 class="h4 mb-4 ">Product Detail</h4> 
					<p>(Holder,Product,Model/Type,Technical data,Test acc.To )</p>
					<br>
					
					<div class="form-group" >
						<input type="text" class="fildStyle  col-md-4" id="detail_name" placeholder="New Detail">
						<input type="text" class="fildStyle  col-md-4" id="detail_name_ara" placeholder="New Detail Arabic" style="margin-left:15px">
						<button type="button" class="fildStyle btn col-md-2" onclick="add_detail()"style="margin-left:15px">Add</button>
					</div>
					<div class="file-field">
						@foreach($detail as $key =>$item)
							<div class="form-group col-md-12 row">
								<div class="choseFileFiled col-md-4">
									<label class="lebelBtn">{{$item->detail_item}}</label>
								</div>
								<div class="choseFileFiled col-md-4"style="margin-left:15px">
									<label class="lebelBtn">{{$item->detail_item_ara}}</label>
								</div>
								
								<div class="col-md-2" style="padding:20px; " >
									<!-- <a href="javascript:edit_product_detail({{$item->id}},'{{$item->detail_item}}')"style="display:inline-text"><h3><img src="{{ URL::asset('assets/front/images/save.png')}}" style="width: 50px; height: 50px;"></h3></a>  -->
									<a href="javascript:delete_product_detail({{$item->id}})"><img src="{{ URL::asset('assets/front/images/delete.png')}}" style="width: 35px; height: 35px;"></a>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<a href="{{url('edit_profile')}}" style="float:right"><button type="button" class="btn btn-primary" >Return</button></a>
		</div>
	</section>
	
@include('includes.footer')
<form class="deletform" action="{{url('delete_product_detail')}}"method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="detail_id" id="detail_id">
</form>
<script>
$(document).ready(function() {

})
	
	function add_detail(){

		if($("#detail_name").val()==''&& $("#detail_name_ara").val()==''){

		}else{
			$.ajax({
	            type : "POST",
	            url: "{{url('insert_product_details')}}",
	            data : {
	               detail: $("#detail_name").val(),
	               detail_ara: $("#detail_name_ara").val(),
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
            	var detail_name_ara = $("#detail_name_ara").val();
            	$('.file-field').append('<div class="form-group col-md-12 row">\n' +

											'\t\t\t\t\t\t\t\t<div class="choseFileFiled col-md-4">\n' +
											'\t\t\t\t\t\t\t\t\t	<label class="lebelBtn">'+$("#detail_name").val()+'</label>\n' +
											'\t\t\t\t\t\t\t\t\t	</div>\n' +
											'\t\t\t\t\t\t\t\t<div class="choseFileFiled col-md-4"style="margin-left:15px">\n' +
											'\t\t\t\t\t\t\t\t\t	<label class="lebelBtn">'+$("#detail_name_ara").val()+'</label>\n' +
											'\t\t\t\t\t\t\t\t\t	</div>\n' +
											'\t\t\t\t\t\t\t\t\t	<div class="col-md-2 ; " style="padding:20px; " >\n' +
											// '\t\t\t\t\t\t\t\t\t     <a href="javascript:edit_product_detail('+detail_id+','+$("#detail_name").val()+')"style="display:inline-text"><h3><img src="{{ URL::asset('assets/front/images/save.png')}}" style="width: 50px; height: 50px;"></h3></a>\n' +
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
    // function edit_product_detail(detail_id,name){
    // 	$('#edit_detail_id').val(detail_id);
    // 	$('#edit_detail_name').val(name);
    	
    // 	$('#modal_button').click();
    // }
	
		
 
</script>
    <!-- // <script src="{{ URL::asset('assets/front/js/multiselect.js')}}"></script> -->
