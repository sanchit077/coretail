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
                           <h3 class="heading">{{ __('Forgot Password')}}</h3>
                     <div class="form-group">
                      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        
                         <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                     </div>
                    
                       
                     <div class="btnCont mt-4">
                        <button class="btn customBtn btn-block">{{ __('Send Password Reset Link') }}</button>
                     </div>
                 </form>

              </div>  
           </div>  
@endsection
