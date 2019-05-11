@extends('layouts/User/loginregister')
@section('title',  __('login.login'))
@section('content')
               <div class="col-lg-5">
                  <div class="loginInner">

                     <h3 class="heading">{{ __('Login')}}</h3>
                     <form action="{{ route('login') }}" method="POST">
                     @csrf
                     <div class="form-group">
                        <label>{{ __('Email Address') }}</label>
                          @error('email')
                        <span class="errorText">This email is not registered to the system</span>
                          @enderror
                        <input class="form-control @error('email') error @enderror" type="email" name="email" placeholder="e.g. John Doe" value="{{ old('email')}}" autocomplete="email" >
                     </div>

                     <div class="form-group">
                        <label>{{ __('Password')}}</label>
                        <input class="form-control @error('password') error @enderror pr-5" id="password-field" type="password" name="password" autocomplete="current-password">
                        <div class="passwordView">
                         <img src="{{asset('user/img/passwordView.png')}}" alt="img" onClick="viewPassword()">
                        </div>

                     </div>
                     <div class="text-left">
                     <a href="{{ route('password.request') }}" class="customLink">
                        {{ __('Forgot Password?')}}
                     </a>
                  </div>

                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block">{{ __('Sign In')}}</button>
                     </div>
                   </form>
                     <div class="belowLink">{{ __('Don’t have an account?')}}  <a href="{{ route('register')}}"> {{ __('Create Account')}}</a></div>



                  </div>
               </div>
            @endsection
