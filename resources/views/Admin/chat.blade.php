@extends('layouts.Admin.login')
@section('title', 'Chat')
@section('content') 
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'bQhxa6EW7i';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE --> </script>
  <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-full-bg">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
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
              <div class="auth-form-dark text-left p-5">
                <h2>Chat Pannel</h2>
                <h4 class="font-weight-light">..............</h4>
                
                </div>
            </div>
          </div>
      
<script> 
</script> 
@endsection