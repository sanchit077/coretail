@extends('layouts.Admin.login')
@section('title',  __('login.login'))
@section('content')
       <div class="col-lg-7 loginBg">
            <div class="logo">
               <a href="index.html">
               <img src="{{asset('bOwner/img/white_logo.png')}}"  alt="img">
               </a>
            </div>
         </div>
            <div class="col-lg-5">
                  <div class="loginInner">
                    <h3 class="heading">{{ __('login.login') }}</h3>

                                  @foreach($errors->all() as $error)
                <div class="alert alert-dismissable alert-danger">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>
                @endforeach

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif


                    <form class="pt-5" method="post" action="{{route('admin_login_post')}}">
                      {{ csrf_field() }}
                     <div class="form-group">
                        <label>{{ __('login.email') }}</label>
                        <span class="errorText"></span> 
                     <input  type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="{{ __('login.email') }}" value="@if(count($details)>0){{ $details['ad_email'] }} @else {{ Request::old('email') }} @endif"/>
                     </div>
                    
                     <div class="form-group">
                        <label>{{ __('login.password') }}</label>

                         <input type="password" name="password" class="form-control pr-5 pass" id="exampleInputPassword1" placeholder="{{ __('login.password') }}" value="@if(count($details)>0){{ $details['ad_psw'] }}@endif"/> 
                        <div class="passwordView" onclick="return showPass();">
                         <button><img src="{{asset('bOwner/img/passwordView.png')}}" alt="img"></button>
                        </div>
                         
                     </div>
                     <div class="text-left">
                     <a href="{{ route('admin.password.request') }}" class="customLink">
                        {{ __('login.forgot_p') }}?
                     </a>
                  </div>
                     <div class="btnCont mt-4">
                        <button class="btn customBtn btn-block">{{ __('login.login') }}</button>
                     </div> 
 
                  </div>
               </div> 
          
	    <script src="{{ asset('admin/node_modules/jquery/dist/jquery.min.js') }}"></script>
      <script> 
		  function showPass(){
			  if($('.pass').attr('type')=='password')
				$('.pass').attr('type', 'text');
				else
				$('.pass').attr('type', 'password');
       return false;
		  } 
      </script>
@endsection
