@extends('layouts/User/loginregister')
@section('content')
               <div class="col-lg-5">
                  <div class="loginInner">
                     <h3 class="heading">{{ __('New Account')}}</h3>
                     <form action="{{ route('register') }}" method="post">
                       @csrf
                     <div class="form-group">
                        <label>{{ __('Full Name')}}</label>
                        <input class="form-control @error('fullname') error @enderror" type="text" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
                     </div>
                     <div class="form-group">
                        <label>{{ __('Email Address')}}</label>
                        <input class="form-control @error('email') error @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                     </div>
                     <div class="form-group">
                        <label>{{ __('Password')}}</label>
                        <input class="form-control pr-5 @error('password') error @enderror" type="password" id="password-field" name="password" required autocomplete="new-password">
                        <div class="passwordView">
                         <img src="{{asset('user/img/passwordView.png')}}" alt="img" onClick="viewPassword()">
                        </div>
                        <div class="pwIndicator">
                           <ul>
                              <li class="one"></li>
                              <li class="two"></li>
                              <li  class="three"></li>
                              <li  class="four"></li>
                           </ul>
                           <p>{{ __('Passwords must be at least 6 characters long and should include letters A-Z, numbers 0-9 or symbols.')}}</p>
                        </div>
                     </div>
                     <div class="acType">
                        <label>{{ __('Account Type')}}</label>

                        <div class="row">
                           <div class="col-sm-6">
                             <label class="blockChkBx">
                             <input type="radio" name="type" value="brandOwner" required @if(old('type')=='brandOwner') checked @endif>
                             <span class="checkmark1 btn">
                                  <i><img src="{{asset('user/img/brand_owner_icon.png')}}" alt="img" /> </i> <span>Brand Owner</span>
                             </span>
                             </label>
                           </div>
                           <div class="col-sm-6">
                             <label class="blockChkBx">
                             <input type="radio" name="type" value="landlord" required @if(old('type')=='landlord') checked @endif>
                             <span class="checkmark1 btn">
                                  <i><img src="{{asset('user/img/landlord_icon.png')}}" alt="img" /> </i> <span>Landlord</span>
                             </span>
                             </label>
                           </div>
                         </div>
                        </div>
                     </div>
                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block">{{ __('Create Account')}}</button>
                     </div>
                   </form>
                     <div class="belowLink">{{ __('Already have an account?')}}  <a href="{{route('login')}}"> {{ __('Login')}} </a></div>
                  </div>
               </div>
            @endsection
