@include('includes.header')
	<section class="ptb40 darkSection">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<div class="payfeesSection">
						<div class="payfeesRow">
							<div class="backArrow"><img src="{{ URL::asset('assets/front/images/arrowLeft.png')}}"></div>
							<div class="payfeesheader">
								<h6>Pay Fees</h6>
								<p>(Pay Using debit or credit card or Bank account)</p>
							</div>
						</div>

						<div class="payUsingTabs">
							<h4>Pay Fees</h4>
							<ul class="nav nav-pills">
								<li class="nav-item">
									<a class="nav-link active cardicon" data-toggle="pill" href="#card">Card</a>
								</li>
								<li class="nav-item">
									<a class="nav-link bankicon" data-toggle="pill" href="#bank">Bank</a>
								</li>
							</ul>

							<div class="tab-content">
								<div class="tab-pane  active" id="card">
									<div class="cardForm">
										<div class="row">
											<div class="col-lg-12 col-sm-12">
												<input type="text" class="cardinput" placeholder="Card Number">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6 col-sm-6"><input type="text" class="cardinput"
													placeholder="EXP Date"></div>
											<div class="col-lg-6 col-sm-6"><input type="text" class="cardinput"
													placeholder="CVV"></div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-sm-12"><input type="text" class="cardinput"
													placeholder="Name on Card"></div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-sm-12">
											<a href="{{url('confirm')}}/{{$evlauate_id}}" ><button class="payBTN">Pay ${{$price}}</button></a>
											</div>
										</div>


									</div>

								</div>
								<div class="tab-pane  fade" id="bank"><div class="cardForm">
									<div class="row">
										<div class="col-lg-12 col-sm-12">
											<input type="text" class="cardinput" placeholder="Card Number">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6"><input type="text" class="cardinput"
												placeholder="EXP Date"></div>
										<div class="col-lg-6 col-sm-6"><input type="text" class="cardinput"
												placeholder="CVV"></div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12"><input type="text" class="cardinput"
												placeholder="Name on Card"></div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12">
										<a href="{{url('confirm/')}}/{{$evlauate_id}}" ><button class="payBTN">Pay ${{$price}}</button></a>
										</div>
									</div>


								</div></div>

							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
@include('includes.footer')