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
                <h2>{{ __('login.admin_reset_p') }}</h2>
                <h4 class="font-weight-light">{{ __('login.reset_p_page_text') }}</h4>
                 <div class="row">
                        <div class="col-lg-12">
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
            						</div>
            					</div>                 
                <form class="pt-4" role="form" method="POST" action="{{ route('admin.password.request') }}"> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('login.email') }}</label>
					{{ csrf_field() }}	
					 <input type="hidden" name="token" value="{{ $token }}">
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="{{ __('login.email') }}" value="{{ old('email') }}" required />
                    <i class="mdi mdi-account"></i>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('login.password') }}</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="{{ __('login.password') }}" />
                    <i class="mdi mdi-eye"></i>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">{{ __('login.c_password') }}</label>
                    <input  type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="{{ __('login.c_password') }}" />
                    <i class="mdi mdi-eye"></i>
                  </div>
                  <div class="mt-5">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium" name="register" type="submit">{{ __('login.r_password') }}</button>
                  </div>
                  
                  <div class="mt-2 text-center">
                    <a href="{{ route('admin_login_get') }}" class="auth-link text-black">{{ __('login.already_reset_p') }} <span class="font-weight-medium">{{ __('login.sign_in') }}</span></a>
                  </div>
                </form>


            
              </div>  
           </div>  
@endsection
