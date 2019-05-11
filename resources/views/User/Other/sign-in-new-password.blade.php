@extends('layouts/User/loginregister')
@section('content')
               <div class="col-lg-5">
                  <div class="loginInner">
                     <h3 class="heading mb-0">{{ __('Reset Password')}}</h3>
                     <p class="p17 mb-4">{{ __('Pick a new password ')}}</p>

                     <form action="{{ route('password.update') }}" method="post">
                       @csrf
                       <input type="hidden" name="token" value="{{ $token }}">
                       <input class="form-control pr-5" type="hidden" name="email" value="{{ $email ?? old('email') }}">
                     <div class="form-group">
                        <label> {{ __('New Password')}}</label>
                        <input class="form-control pr-5 @error('password') error @enderror" type="password" id="password-field" name="password" required autocomplete="new-password">
                        <div class="passwordView">
                         <img src="{{asset('user/img/passwordView.png')}}" alt="img" onClick="viewPassword()">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                      <div class="form-group">
                        <label> {{ __('Repeat New Password')}}</label>
                        <input class="form-control pr-5" type="password" id="conpassword-field" name="password_confirmation" required autocomplete="new-password">

                        <div class="passwordView">
                         <img src="{{asset('user/img/passwordView.png')}}" alt="img" onClick="viewconPassword()">
                        </div>

                     </div>

                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block"> {{ __('Reset Password')}}</button>
                     </div>
                   </form>



                  </div>
               </div>
          @endsection
