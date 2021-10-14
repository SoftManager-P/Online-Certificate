@include('includes.header')
	<section class="ptb50 darkSection">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2 pdfConfirm">
					<div class="pdficon"><img src="{{ URL::asset('assets/front/images/pdfdownload.png')}}"style="width: 100px; height: 100px;"></div>
					<p class="greenText">Your {{$sector_name}} Sector document has been submitted for approval</p>
					<p>You will get notification by email when your document review has been completed.</p>
					<p>Then you are able to print certified document.</p>
					 
					<a href="{{url('about_us')}}" class="btn btnBorderRed mt80">Discover more about MCI ></a>
				</div>
				 
			</div>
		</div>
	</section>

	@include('includes.footer')