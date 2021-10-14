@include('includes.header')
	<section class="ptb60 darkSection minHeightFull alignCenter">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<div class="wrap400">
						<h4 class="h4 mb-4">Log In</h4>
						<br>

						@if ($message = Session::get('log_err'))
						<div class="alert alert-danger alert-dismissable margin5">
						    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						    <strong>Error:</strong> {{$message}}
						</div>
						@endif
						<form class="formStyle formStyle_2" action="{{url('signin')}}" autocomplete="on" method="post"  role="form">
							@csrf
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" name="email" class="fildStyle" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="Password" name="password" class="fildStyle" required>
								<button type="button" class="p_hideShow"><i class="fas fa-eye-slash"></i></button>
							</div>
							<div class="form-group">
								<button type="Submit" class="btn btnfull">Log In</button>
							</div>
							<div class="form-group text-center">
								<a href="{{url('forgot_password')}}" class="redLink">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@include('includes.footer')