@include('includes.header')
<section class="ptb60 darkSection minHeightFull alignCenter">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<div class="wrap400">
						<div class="titleHead mb-3">
							<div class="userImg">
								<span></span>
							</div>
							<div class="textCol">
								<h4 class="h4">Edit Profile</h4>
								<p>(You can update your basic and company info here)</p>
							</div>							
						</div>
						
						<form class="formStyle formStyle_2" action="{{url('/insert_user')}}" autocomplete="on" method="post" role="form" >
							  @csrf
							@if ($message = Session::get('edit_success_msg'))
							<div class="alert alert-success alert-dismissable margin5">
							    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							    <strong>Success:</strong> {{ $message }}
							</div>
						    @endif
							<div class="row">
								<input type="hidden" name="id" value="{!! isset($user)? $user[0]->id:''  !!}" />
								<div class="form-group row" style="display: none;" >
                                    <label class="col-sm-4" >User Role</label>
                                    <div class="col-sm-7" style="padding:0px">
                                    <select class="form-control " name="user_role" >
                                        <option value="customer" selected="selected">Customer</option>
                                    </select>
                                    </div>
                                </div>
								<div class="col-md-6 col-12">
									
									<div class="form-group">
										<input type="text" name="first_name" placeholder="First Name" class="fildStyle" value="{!! isset($user) ? $user[0]->first_name:old('first_name') !!}">
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<input type="text" name="last_name" placeholder="Last Name" class="fildStyle" value="{!! isset($user)? $user[0]->last_name:old('last_name') !!}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="email" placeholder="Email Address" class="fildStyle" value="{!! isset($user)? $user[0]->email:old('email') !!}">
							</div>
							<div class="form-group">
								<!-- <div class="mobileNoContryCode"> -->
									<!-- <span class="contryCode_"><img src="{{ URL::asset('assets/front/images/flag.jpg')}}"> +968</span> -->
									<input type="text" name="phone" placeholder="Enter Mobile Number" class="fildStyle" value="{!! isset($user)? $user[0]->phone:old('phone') !!}">
								<!-- </div> -->
							</div>
							<div class="form-group">
								<input type="text" name="address" placeholder="Address" class="fildStyle" value="{!! isset($user)? $user[0]->address:old('address') !!}">
							</div>
							<div class="form-group">
								<input type="text" name="company_name" placeholder="Company Name" class="fildStyle" value="{!! isset($user)? $user[0]->company_name:old('company_name') !!}">
							</div>
							
							<div class="form-group">
								<input type="Password" name="password" placeholder="Password" class="fildStyle" value="">
							</div>
							<div class="form-group">
								<button type="Submit" class="btn btnfull">Update</button>
							</div>
							<a href="{{url('productdetail')}}" class="redLink">Product Details Info</a>
							<a href="{{url('product_list')}}" class="redLink" style="float:right">Products List</a>
							
						</form>
					</div>
				</div>
				<div class="col-">
					
				</div>
			</div>
		</div>
</section>
@include('includes.footer')

<script type="text/javascript">
	
</script>
