@extends('layouts/User/loginregister')
@section('content')
               <div class="col-lg-5">
                  <div class="inboxNotification">
                     <a href="javascript://" class="figBlock">
                         <img src="{{ asset('user/img/check_your_inbox_illustration.png')}}"  alt="img">
                         <span class="msgCount">1</span>
                     </a>
                     <h4 class="h24">Check your Inbox</h4>
                     <p class="p18">Please Check your Inbox for confirmation link that we have sent you there to activate your account.</p>
                  </div>
               </div>
          @endsection
