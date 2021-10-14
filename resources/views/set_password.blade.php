@include('includes.header')
	<section class="ptb60 darkSection minHeightFull alignCenter">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<div class="wrap400">
					@if ($message = Session::get('success_msg'))
							<div class="alert alert-success alert-dismissable margin5">
							    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							    {{ $message }}
							</div>
					@endif
					@if ($message = Session::get('forgot_err'))
							<div class="alert alert-success alert-dismissable margin5">
							    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							    {{ $message }}
							</div>
					@endif
						<h4 class="h4 mb-4">Recover Password</h4>
						<br>

						<form class="formStyle formStyle_2" action="{{url('update_password')}}" autocomplete="on" method="post"  role="form">
							@csrf
							<input type="hidden" name="token" value="{{$token}}" >
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
							
							<div class="form-group">
								<button type="Submit" class="btn btnfull">Save</button>
							</div>
							<div class="form-group text-center">
								<a href="{{url('login')}}" class="redLink">Log In</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@include('includes.footer')