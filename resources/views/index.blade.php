@include('includes.header')
	<section class="banner_BG">
		<div id="demo" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="{{ URL::asset('assets/front/images/slider01.jpg')}}" alt="Slider">
				</div>
				<div class="carousel-item">
					<img src="{{ URL::asset('assets/front/images/slider01.jpg')}}" alt="Slider">
				</div>
				<div class="carousel-item">
					<img src="{{ URL::asset('assets/front/images/slider01.jpg')}}" alt="Slider">
				</div>
			</div>
		</div>
	</section>
	<section class="ptb50">

		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
					<h2 class="sectionTitle">Our Services</h2>
					<p class="sectionSubtitle">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
				</div>
				<div class="col-lg-8 col-sm-8 offset-lg-2 offset-sm-2 ourservicesTop80 ourServicesGraphics">
					<p class="labelTitle">Approve test report</p>
					<img src="{{ URL::asset('assets/front/images/our-services.jpg')}}">

					<a href="#" class="btn">Discover more about MCI ></a>
				</div>
			</div>
		</div>
	</section>
	<section class="ptb50 darkSection">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
					<h3 class="sectionicon"><img src="{{ URL::asset('assets/front/images/getCertificationicon.png')}}"></h3>
					<h2 class="sectionTitle2">How to get certificate?</h2>
					<p class="sectionSubtitle">Get your certificate in 3 easy steps<br />
						The process is very simple you can just submit required documents </p>
				</div>
				<div class="col-lg-8 col-sm-8 offset-lg-2 offset-sm-2 ourservicesTop80 ourServicesGraphics">
					<img src="{{ URL::asset('assets/front/images/get-certificate-timeline.png')}}">
				</div>
			</div>
		</div>
	</section>
	<section class="ptb50 globalSection">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<h2 class="sectionTitle3">We are global</h2>
					<p class="sectionSubtitle">Lorem Ipsum is simply dummy text of the printing and typesetting
						industry. Lorem Ipsum has been the industry's standard dummy</p>

					<div class="mapCount">
						<div class="mapCountBox">
							<h3>84,00</h3>
							<h6>clients in...</h6>

						</div>
						<div class="mapCountBox">
							<h3>193</h3>
							<h6>countries</h6>
						</div>

					</div>

				</div>
				<div class="col-lg-6 col-sm-6">
					<img src="{{ URL::asset('assets/front/images/map.png')}}" class="mobileView">

				</div>
			</div>
		</div>
	</section>
	<section class="ptb50 testimonialSection">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 textcenter">
					<p class="testimonialText">"Lorem Ipsum is simply dummy text of the printing and typesetting
						industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
						unknown printer took a galley
						of type and scrambled it to make a type specimen book. It has survived not only five centuries,
						but also the leap into electronic typesetting, remaining essentially unchanged."</p>
					<p class="testimonialAuthor">Joshua f. fernando, progra director - BPEG head, Mindtree limited</p>
					<a href="#" class="watchHere">Watch here ></a>

				</div>

			</div>
		</div>
	</section>
@include('includes.footer')
