@extends('layouts/User/loginregister')
@section('content')
               <div class="col-lg-5">
                  <div class="loginInner">
                     <h3 class="heading">{{ __('Forgot Password')}}</h3>
                     @if (session('status'))
                         <div class="alert alert-success" role="alert">
                             {{ session('status') }}
                         </div>
                     @endif

                     <form action="{{ route('password.email') }}" method="POST">
                       @csrf
                     <div class="form-group">
                        <label>{{ __('Email Address')}}</label>

                        <input class="form-control @error('email') error @enderror" type="email" name="email" placeholder="mr.xeious@gmail.com" value="{{ old('email') }}" autocomplete="email" required autofocus>
                     </div>
                     @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror


                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block">{{ __('Reset Password')}}</button>
                     </div>
                 </form>



                  </div>
               </div>
          @endsection
