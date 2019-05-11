<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Co-Retail</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{ asset('/bOwner/css/custom.css') }}">
      <link rel="stylesheet" href="{{ asset('/bOwner/css/bootstrap.min.css') }}">
      <script src="{{ asset('/bOwner/js/jquery.min.js') }}"></script>
      <script src="{{ asset('/bOwner/js/popper.min.js') }}"></script>
      <script src="{{ asset('/bOwner/js/bootstrap.min.js') }}"></script>
   </head>
   <body>
      <div class="loginMain">
         <div class="container-fluid">
            <div class="row">
				@yield('content') 
		 </div>
         </div>
      </div>
   </body>
</html>