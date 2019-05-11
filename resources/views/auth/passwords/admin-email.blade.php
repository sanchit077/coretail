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
                  <h3 class="heading">{{ __('login.admin_reset_p') }}</h3>
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
                  <form class="pt-5" method="post" action="{{route('admin.password.email')}}">
                      {{ csrf_field() }}
                  <div class="form-group">
                  <label for="email" >{{ __('E-Mail Address') }}</label>
                   <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                  </div>
                   <div class="btnCont mt-4">
                          <button class="btn customBtn btn-block">{{ __('Send Password Reset Link') }}</button>
                   </div>
                 </form>
                     <div class="mt-2 text-center">
                    <a href="{{ route('admin_login_get') }}" class="auth-link text-black">{{ __('login.already_have_account') }} <span class="font-weight-medium">{{ __('login.sign_in') }}</span></a>
                  </div> 
               
                  
              
            
              </div>  
           </div>  
@endsection
