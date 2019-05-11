  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('admin_dashboard') }}"><img src="{{ asset('admin/images/logotipoGpi.png') }}" alt="logo" /></a>
         <a class="navbar-brand brand-logo-mini" href="{{ route('admin_dashboard') }}"><img src="{{ asset('admin/images/gpi_mini.jpg') }}" alt="Re" style="background-color: white; width: 100% !important;"/></a> 
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
            @if(isset($admin->user_type) && $admin->user_type=='admin') 
        <ul class="navbar-nav">
          <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle nav-btn" id="actionDropdown" href="#" data-toggle="dropdown">
              <span class="btn">+ {{ __('admin_dashboard.create_new') }}</span>
            </a>
            <div class="dropdown-menu navbar-dropdown dropdown-left" aria-labelledby="actionDropdown">
              <a class="dropdown-item" href="{{ route('admin_user_add_get_2') }}">
                <i class="icon-user text-primary"></i>
               {{ __('admin_dashboard.create_new_u') }}
              </a>
             
            </div>
          </li>
        </ul>
            @endif 
        <ul class="navbar-nav navbar-nav-right">
			 <li class="nav-item d-none d-lg-flex">
            <span class="lead welcome-message" >{{ __('admin_dashboard.admin_header') }}</span>
          </li> 
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
   
<script> 
 jQuery('.navbar-toggler').on('click',function(){      
   if (jQuery("body").hasClass("sidebar-icon-only")==true) { 
           jQuery(".navbar.navbar-brand-wrapper.navbar-brand").css("background-color","white"); 
    }else{
          jQuery(".navbar.navbar-brand-wrapper.navbar-brand").css("background-color","#15BDC5"); 
    } 
 }); 
</script>>