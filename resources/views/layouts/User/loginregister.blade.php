<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Co-Retail</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{asset('user/css/custom.css')}}">
      <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <script src="{{asset('user/js/jquery.min.js')}}"></script>
      <script src="{{asset('user/js/popper.min.js')}}"></script>
      <script src="{{asset('user/js/bootstrap.min.js')}}"></script>
      <style>
      .inboxNotification{
        margin-top: 180px;
      }
      .input-hidden {
    position: absolute;
    left: -9999px;
  }

  input[type=radio]:checked + label>img {
    border: 1px solid #fff;
    box-shadow: 0 0 3px 3px #090;
  }

  /* Stuff after this is only to make things more pretty */
  input[type=radio] + label>img {
    border: 1px dashed #444;
    width: 150px;
    height: 150px;
    transition: 500ms all;
  }

  input[type=radio]:checked + label>img {
    transform:
      rotateZ(-10deg)
      rotateX(10deg);
  }

  /*
   | //lea.verou.me/css3patterns
   | Because white bgs are boring.
  */

      </style>
   </head>
   <body>
      <div class="loginMain">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-7 loginBg">
                  <div class="logo">
                     <a href="index.html">
                     <img src="{{asset('user/img/white_logo.png')}}"  alt="img">
                     </a>
                  </div>
               </div>
 @yield('content')
             </div>
          </div>
       </div>
    </body>
    <script>
  function viewPassword(){
      var passwordInput = document.getElementById('password-field');
      if (passwordInput.type == 'password')
        {
          passwordInput.type='text';
        }
        else
        {
          passwordInput.type='password';
        }
}

function viewconPassword(){
    var passwordInput = document.getElementById('conpassword-field');
    if (passwordInput.type == 'password')
      {
        passwordInput.type='text';
      }
      else
      {
        passwordInput.type='password';
      }
}

$('#password-field').keyup(function() {
  var meter=this.value;
    var strength = 0;
    if (meter.length > 6) strength += 1
    if (meter.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
    if (meter.match(/([a-zA-Z])/) && meter.match(/([0-9])/)) strength += 1
    if (meter.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    if(strength == 0){
      $(".one").removeClass('selected');
      $(".two").removeClass('selected');
      $(".three").removeClass('selected');
      $(".four").removeClass('selected');
    }
    if(strength == 1){
      $(".one").addClass('selected');
      $(".two").removeClass('selected');
      $(".three").removeClass('selected');
      $(".four").removeClass('selected');
    }
    if(strength==2){
      $(".one").addClass('selected');
      $(".two").addClass('selected');
      $(".three").removeClass('selected');
      $(".four").removeClass('selected');
    }
    if(strength==3){
      $(".one").addClass('selected');
      $(".two").addClass('selected');
      $(".three").addClass('selected');
      $(".four").removeClass('selected');
    }
    if(strength==4){
      $(".one").addClass('selected');
      $(".two").addClass('selected');
      $(".three").addClass('selected');
      $(".four").addClass('selected');
    }

    console.log(strength);
   });

   $('#sites input:radio').addClass('input_hidden');
$('#sites label').click(function() {
    $(this).addClass('selected').siblings().removeClass('selected');
});
    </script>
 </html>
