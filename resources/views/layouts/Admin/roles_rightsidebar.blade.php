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
                </div>
              </div>
            </li>  
          
            <li class="nav-item  @if($currentPath=='admin_roles_dashboard'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_roles_dashboard') }}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">{{ __('admin_dashboard.dashboard') }}</span> 
              </a>
            </li> 

  <!-- @ if($admin->hasAnyRole(['admin','credit_analyst','branch_manager','account_executive','customer_support']))  -->
          

           @if($admin->hasAnyRole(['admin|customer_support'])) 
            <li class="nav-item  @if($currentPath=='admin_user_all_2'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_user_all_2') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{{ __('admin_dashboard.manage_user') }}</span> 
              </a>
            </li>
            <li class="nav-item  @if($currentPath=='administrator_application_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('administrator_application_all') }}">
                <i class="fa fa-rocket menu-icon"></i>
                <span class="menu-title">{{ __('admin_application.manage_application') }}</span> 
              </a>
            </li>
            
            @endif

            @if($admin->hasAnyRole(['admin'])) 
            <li class="nav-item  @if($currentPath=='administrator_appointments_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('administrator_appointments_all') }}">
                <i class="fa fa-diamond menu-icon"></i>
                <span class="menu-title">{{ __('admin_appointment.manage_appointments') }}</span> 
              </a>
            </li>            
            @endif

            @if($admin->hasAnyRole(['credit_analyst'])) 
            <li class="nav-item  @if($currentPath=='admin_request_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_request_all') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{{ __('admin_request.manage_requests') }}</span> 
              </a>
            </li>  
            @endif

            @if($admin->hasAnyRole(['branch_manager'])) 
            <li class="nav-item  @if($currentPath=='approved_request_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('approved_request_all') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{{ __('admin_request.manage_requests') }}</span> 
              </a>
            </li>  
         <!--    <li class="nav-item  @ if($currentPath=='admin_contract_all'){{ 'active' }} @ endif">
              <a class="nav-link" href="{ { route('admin_contract_all') } }">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{ { __('admin_contract.manage_contracts') } }</span> 
              </a>
            </li>  --> 
            @endif

            @if($admin->hasAnyRole(['account_executive'])) 
            <li class="nav-item  @if($currentPath=='admin_document_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_document_all') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{{ __('admin_document.manage_document') }}</span> 
              </a>
            </li>  
            @endif

            @if($admin->hasAnyRole(['customer_support'])) 
            <li class="nav-item  @if($currentPath=='admin_chat_all'){{ 'active' }} @endif">
              <a class="nav-link" href="{{ route('admin_chat_all') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{{ __('admin_chat.manage_chat') }}</span> 
              </a>
            </li>  
            @endif
            <li class="nav-item @if($currentControoler == 'AdminController' && $currentPath !='admin_dashboard'){{ 'active' }} @endif">
              <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <i class="fa fa-cogs menu-icon"></i>
                <span class="menu-title">{{ __('admin_dashboard.admin_setting') }}</span> 
              </a>
              <div class="collapse @if($currentControoler=='AdminController' && $currentPath !='admin_dashboard'){{ 'show' }} @endif" id="general-pages">
                <ul class="nav flex-column sub-menu"> 
                  <li  class="nav-item @if($currentPath=='aprofile_update_get'){{ 'active' }} @endif"> <a class="nav-link" href="{{ route('aprofile_update_get_role') }}">{{ __('admin_dashboard.update_profile') }}</a></li>
                  <li  class="nav-item @if($currentPath=='apassword_update_get_role'){{ 'active' }} @endif"> <a class="nav-link" href="{{ route('apassword_update_get_role') }}">{{ __('admin_dashboard.update_password') }}</a></li> 
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
       
