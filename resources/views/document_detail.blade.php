<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ministry of Commerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('assets/front/images/favicon.png')}}" />

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/jquery.fancybox.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/pull-push.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/multiselect.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/fontawesome-all.css')}}">
    <link href="{{ URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/regular.css"
        integrity="sha384-zkhEzh7td0PG30vxQk1D9liRKeizzot4eqkJ8gB3/I+mZ1rjgQk+BSt2F6rT2c+I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css"
        integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous"> -->
</head>
<body class="">
	<section class="ptb60 darkSection minHeightFull">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12 p_col offset-lg-2">
					<h4 class="h4 mb-4">Documents View({{$eval_his->sector_name}})</h4> 
					
					<br>
					
						<div class="file-field">
							@foreach($service as $key =>$service_item)
								@foreach($service_item['document_url'] as $key1 => $item)
								<div class="form-group col-md-12 row">
									<div class="choseFileFiled col-md-8">
										<span class="fileText"><img src="{{ URL::asset('assets/front/images/uploadFile.jpg')}}"> {{$service_item['service_name']->name}} sevice file</span>
									</div>
									<div class="col-md-2">
										<a href="{{url('')}}{{$item->document_url}}" target="_blank"><img src="{{ URL::asset('assets/front/images/pdf-icon.png')}}"></a>
									</div>
								</div>
								@endforeach
							@endforeach
						</div>
						
				</div>
			</div>
		</div>
	</section>
	
<!-- @include('includes.footer') -->

