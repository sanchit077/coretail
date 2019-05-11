<!DOCTYPE html>
<html lang="en">
<head>  
    <title>CoRetail Web Admin - @yield('title')</title> 

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
   <link rel="stylesheet" href="{{ asset('/admin/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('/admin/css/style.css') }}">
   <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="{{ asset('/admin/js/jquery.min.js') }}"></script>
   <script src="{{ asset('/admin/js/popper.min.js') }}"></script>
   <script src="{{ asset('/admin/js/bootstrap.min.js') }}"></script>
</head>

<body>
	<section id="">
        <div class="sidebar">
				@include('layouts.Admin.sidebar') 
		</div>
		<div class="page-container">
			<div class="header navbar">  
			   @include('layouts.Admin.header')
 			</div>
			<main class="main-content bgc-grey-100">
				<div id="mainContent">
			    	@foreach($errors->all() as $error)
	                    <div class="alert alert-dismissable alert-danger">
	                        {!! $error !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                    </div>
                    @endforeach
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						</div>
					@endif 
						@yield('content') 
                </div>
			</main>
		</div>
	</section>
</body> 
</html> 