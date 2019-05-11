 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <?php 
        $currentControoler  = class_basename(Route::current()->controller); 
        $currentPath = Route::currentRouteName(); //Route::getCurrentRoute()->getActionName();
     ?>
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image">
                    @if(isset($admin->profile_pic)&& !empty($admin->profile_pic))
                  <img src="{{ env('FILE_URL').$admin->profile_pic }}" alt="image" />
                  @else
                  <img src="{{ asset('admin/images/faces/face10.jpg') }}" alt="image" />
                  @endif
                 <!-- <span class="online-status online"></span>-->
                  <!--change class online to offline or busy as needed-->
                </div>
                <div class="profile-name">
                  <p class="name">
                   {{ $admin->name }}
                  </p>
                  <p class="designation"> 
                    {{ $admin->job }} 
                  </p>
                </div>
              </div>
            </li>  
          
            <li class="nav-item  @if($currentPath=='admin_dashboard'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_dashboard') }}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">{{ __('admin_dashboard.dashboard') }}</span> 
              </a>
            </li>
         <!--   <li class="nav-item @if($currentControoler=='AdminCategoryController'){{ 'active' }} @endif" >
              <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Manage Categories</span> 
              </a>
              <div class="collapse @if($currentControoler=='AdminCategoryController'){{ 'show' }} @endif" id="sidebar-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item @if($currentPath=='admin_category_all'){{ 'active' }} @endif"> <a class="nav-link" href="">All Categories</a></li>
                  <li class="nav-item @if($currentPath=='admin_subcategory_all'){{ 'active' }} @endif"> <a class="nav-link" href="">All Sub-Categories</a></li> 
                </ul>
              </div>
            </li> 
            <li class="nav-item  @if($currentPath=='admin_business_all'){{ 'active' }} @endif">
              <a class="nav-link" href="">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Manage Businesses</span> 
              </a>
            </li>
            <li class="nav-item  @if($currentPath=='admin_product_all' && $currentControoler=='AdminProductController'){{ 'active' }} @endif">
              <a class="nav-link" href="">
                <i class="icon-globe menu-icon"></i>
                <span class="menu-title">Manage Products</span> 
              </a>
		</li>
             
            <li class="nav-item  @if($currentPath=='admin_service_all'){{ 'active' }} @endif">
              <a class="nav-link" href="">
                <i class="fa fa-gavel menu-icon"></i>
                <span class="menu-title">Manage Services</span> 
              </a>
            </li>-->
            <li class="nav-item  @if($currentPath=='admin_user_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_user_all') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{{ __('admin_dashboard.manage_user') }}</span> 
              </a>
            </li>

         <li class="nav-item  @if($currentPath=='admin_b_user_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_b_user_all') }}">
                <i class="fa fa-user-circle-o menu-icon"></i>
                <span class="menu-title">{{ __('admin_user.manage_sadmin') }}</span> 
              </a>
            </li>       
            <li class="nav-item  @if($currentPath=='admin_banner_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_banner_all') }}">
                <i class="fa fa-truck menu-icon"></i>
                <span class="menu-title">{{ __('admin_banner.manage_banner') }}</span> 
              </a>
            </li>
            <li class="nav-item  @if($currentPath=='admin_application_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_application_all') }}">
                <i class="fa fa-truck menu-icon"></i>
                <span class="menu-title">{{ __('admin_application.manage_application') }}</span> 
              </a>
            </li>
              <li class="nav-item  @if($currentPath=='admin_appointments_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_appointments_all') }}">
                <i class="fa fa-truck menu-icon"></i>
                <span class="menu-title">{{ __('admin_appointment.manage_appointments') }}</span> 
              </a>
            </li>
              <li class="nav-item  @if($currentPath=='admin_blog_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_blog_all') }}">
                <i class="fa fa-vcard-o menu-icon"></i>
                <span class="menu-title">{{ __('admin_blog.manage_blog') }}</span> 
              </a>
            </li>  
            <li class="nav-item @if($currentControoler == 'AdminController' && $currentPath !='admin_dashboard'){{ 'active' }} @endif">
              <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <i class="fa fa-cogs menu-icon"></i>
                <span class="menu-title">{{ __('admin_dashboard.admin_setting') }}</span> 
              </a>
              <div class="collapse @if($currentControoler=='AdminController' && $currentPath !='admin_dashboard'){{ 'show' }} @endif" id="general-pages">
                <ul class="nav flex-column sub-menu"> 
                  <li  class="nav-item @if($currentPath=='aprofile_update_get'){{ 'active' }} @endif"> <a class="nav-link" href="{{ route('aprofile_update_get') }}">{{ __('admin_dashboard.update_profile') }}</a></li>
                  <li  class="nav-item @if($currentPath=='apassword_update_get'){{ 'active' }} @endif"> <a class="nav-link" href="{{ route('apassword_update_get') }}">{{ __('admin_dashboard.update_password') }}</a></li> 
                </ul>
              </div>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin_logout')}}" onclick="return confirm('{{ __("admin_dashboard.sign_out_confirmation") }}?')">
                <i class="fa fa-sign-out menu-icon"></i>
                <span class="menu-title">{{ __('admin_dashboard.sign_out') }}</span>
              </a>
            </li> 
          </ul>
        </nav>
       
