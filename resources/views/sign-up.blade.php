@include('includes.header')

	<section class="ptb60 darkSection minHeightFull alignCenter">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<div class="wrap400">
						<h4 class="h4 mb-4">Sign up</h4>
						<br>
						@if ($message = Session::get('signup_msg'))
						<div class="alert alert-danger alert-dismissable margin5">
						    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						    <strong>Error:</strong> {{$message}}
						</div>
						@endif
						@if ($message = Session::get('signup_success_msg'))
							<div class="alert alert-success alert-dismissable margin5">
							    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							    <strong>Success:</strong> {{ $message }}
							</div>
						@endif
						<form class="formStyle formStyle_2" action="{{ url('signup') }}" autocomplete="on" method="post" role="form">
							@csrf
							<div class="row">
								<div class="col-md-6 col-12">
									<div class="form-group">
										<input type="text" name="first_name" placeholder="First Name" class="fildStyle" required value="{!! old('first_name') !!}">
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<input type="text" name="last_name" placeholder="Last Name" class="fildStyle" required value="{!! old('last_name') !!}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="email" placeholder="Email Address" class="fildStyle" required value="{!! old('email') !!}">
							</div>
							<div class="form-group">
								<!-- <div class="mobileNoContryCode"> -->
									<!-- <span class="contryCode_"><img src="{{ URL::asset('assets/front/images/flag.jpg')}}"> +968</span> -->
									<input type="text" name="phone" placeholder="Enter Mobile Number" class="fildStyle" required value="{!! old('phone') !!}">
								<!-- </div> -->
							</div>
							<div class="form-group">
								<input type="text" name="company_name" placeholder="Company Name" class="fildStyle" required value="{!! old('company_name') !!}">
							</div>
							<div class="form-group form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" id="food-check" name="food_section" onchange="food_sec(this);" value="checked"> Food Section 
								</label>
								<button type="button" class="btn report_btn" style=" padding: 8px 18px; min-width: 10%; display:none; float:right" data-toggle="modal" data-target=".bs-example-modal-lg"  onclick="modal_show()">Report</button>
							</div>
							
							<div class="form-group">
								<input type="Password" name="password" placeholder="Password" class="fildStyle" required >
							</div>
							<div class="form-group">
								<input type="Password" name="password_confirmation" placeholder="Conform Password" class="fildStyle" required >
								@if (Session::get('pas_err'))
									<span class="" style="color:red;" >
                                        <strong>Recheck your password!</strong>
                                    </span>
	                            @endif
							</div>
							
							<div class="form-group form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="check" value="checked"> By Signing up, I Agree to the all <a href="#" class="redLink">Terms & Policy</a>
								</label>
							</div>
							
							<div class="form-group">
								<button type="submit" class="submit_btn" style="dispaly:none"></button>
								<button type="button" class="btn btnfull">Sign Up</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- <button type="button" class="btn btn-primary waves-effect waves-light hidden" style="display: ;" data-toggle="modal" data-target=".bs-example-modal-center" id="modal_button"></button> -->
	

	@include('includes.footer')

<script>
	$('.btnfull').on('click',function(){
		// if($('#food-check')[0].checked == true){
		// 	$('.formStyle_2').append($('#upload_file').html());
		// }

		$('.submit_btn').click();
	})

	// function food_sec(check){
	// 	if(check.checked == true){
	// 		$('.report_btn').css('display','');
	// 	}else{
	// 		$('.report_btn').css('display','none');
	// 	}
	// }

	// function add_service(){
	// 	if($("#service_name").val()==''){

	// 	}else{
	// 		$.ajax({
 //            type : "POST",
 //            url: "{{url('insert_foodservice')}}",
 //            data : {
 //               service_name: $("#service_name").val(),
 //            },
 //             headers: {
 //                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
 //                    },
 //            success : function(data) {
 //            	var service_id = JSON.parse(data);
 //            	$('#service_ids').val($('#service_ids').val()+service_id+',');
 //            	$('#upload_file').append('<div class="form-group">\n' +
	// 		        '\t\t\t\t\t\t\t\t<div class="choseFileFiled">\n' +
	// 		        '\t\t\t\t\t\t\t\t\t<input type="file" accept="doc/pdf" required name="service_'+service_id+'" onchange="preview(this);">\n' +
	// 		        '\t\t\t\t\t\t\t\t\t<span class="fileText"><img src=""> Upload '+$("#service_name").val()+' file</span>\n' +
	// 		        '\t\t\t\t\t\t\t\t\t<label class="lebelBtn">Select file</label>\n' +
	// 		        '\t\t\t\t\t\t\t\t</div>\n' +
	// 		        '\t\t\t\t\t\t\t</div>');
 //                return;
 //            }
 //        });
	// 	}
		
	// }


	// window.preview = function (input) {
 //        if (input.files && input.files[0]) {
 //        	$(input.files).each(function () {
 //        		var s =this.name;
 //        		$(input).parent().find('.fileText').html(s);
 //        	})
 //        }
 //    };

	// function modal_show(){
	// 	var s = 's';
	// }

</script>