@include('includes.header')
<section class="ptb60 minHeightFull_41 alignCenter">
		<a href="get-otp.html" class="btn_close"><i class="fas fa-times"></i></a>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-12 p_col offset-lg-3">
					<div class="wrap400 otpwrap">
						<div class="logo_Col">
							<img src="{{ URL::asset('assets/front/images/logo_2.jpg')}}">
						</div>
						<form class="formStyle formStyle_2">
							<div class="form-group smsGet">
								<p>You will get a code via sms in</p>
								<label class="bold">+968812812018021</label>
							</div>
							<div class="form-group otp_Code">
								<input type="password" name="" value="1" maxlength="1">
								<input type="password" name="" value="1" maxlength="1">
								<input type="password" name="" value="1" maxlength="1">
								<input type="password" name="" maxlength="1">
							</div>
							<div class="form-group">
								<button type="Submit" class="btn btnfull">Verify</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</section>
@include('includes.footer')