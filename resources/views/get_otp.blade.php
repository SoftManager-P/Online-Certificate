@include('includes.header')
<section class="ptb60 minHeightFull_41 alignCenter">
		<a href="pay-fees.html" class="btn_close"><i class="fas fa-times"></i></a>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-12 p_col offset-lg-3">
					<div class="wrap400 otpwrap">
						<div class="logo_Col">
							<img src="{{ URL::asset('assets/front/images/logo_2.jpg')}}">
						</div>
						<form class="formStyle formStyle_2">
							<div class="form-group">
								<label class="bold">Enter mobile number</label>
								<div class="mobileNoContryCode">
									<span class="contryCode_"><img src="{{ URL::asset('assets/front/images/flag.jpg')}}"> +968</span>
									<input type="text" name="" placeholder="Enter Mobile Number" class="fildStyle">
								</div>
							</div>
							<div class="form-group">
								<button type="Submit" class="btn btnfull">Get OTP</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</section>
@include('includes.footer')