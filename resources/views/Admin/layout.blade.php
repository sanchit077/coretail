<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="icon" type="image/png" href="/admin/Images/assets/Login_logo.png"/>

    <title>@yield('title') - {{env('APP_NAME')}}</title>

    <script src="/admin/js/jquery-2.1.1.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="/admin/js/bootstrap.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->


    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css" rel="stylesheet">
    <link href="/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="/admin/css/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css">
    <link href="/admin/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">

           <!-- Data Tables -->
    <link href="/admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/admin/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="/admin/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

    <script src="/admin/js/plugins/fullcalendar/moment.min.js"></script>
    <!-- Data Tables -->
    <script src="/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/admin/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/admin/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <style>

        body
            {
                font-size:12px !important;
            }
        .btn
            {
                font-size: 12px !important;
            }
        .lightBoxGallery 
            {
                text-align: center;
            }
        .img-circle
            {
                width: 50px !important;
                height: 50px !important;
            }
        .tableclass
            {
                    overflow-x: overlay;
            }

    </style>


</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            
            <a href="#">
               <img alt="image" class="img-circle" src="{!! $admin->pic_url !!}" /> 
            </a>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{!! $admin->name !!}</strong>
                             </span> <span class="text-muted text-xs block">{!! $admin->job !!} <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
              <li><a href="{ { route('aprofile_update_get')}}"><i class="fa fa-child"></i>  Profile Update</a></li>
              <li><a href="{ { route('apassword_update_get')}}"><i class="fa fa-cog"></i>  Password Update</a></li>
                                <li class="divider"></li>
                                <li><a id="demo331" class="demo331" ><i class="fa fa-sign-out"></i>  Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                          Reveola
                        </div>
    </li>

                        <li id="dashboard" title="Dashboard">
                            <a href="{ ! ! route('admin_dashboard') !!}">
                                <i class="fa fa-th-large"></i>
                                    <span class="nav-label">Dashboard</span>
                            </a>
                        </li>

                        <li id="users_all" title="Users">
                            <a href="{ ! ! route('admin_user_all') !!}">
                                <i class="fa fa-users"></i>
                                    <span class="nav-label">Users</span>
                            </a>
                        </li>

                        <li id="products_all" title="Products">
                            <a href="{ ! ! route('admin_products_all') !!}">
                                <i class="fa fa-product-hunt"></i>
                                    <span class="nav-label">Products</span>
                            </a>
                        </li>

                        <li id="sales_all" title="Sales">
                            <a href="{ ! ! route('admin_sales_all') !!}">
                                <i class="fa fa-dollar"></i>
                                    <span class="nav-label">Sales</span>
                            </a>
                        </li>

                        <li id="contacts_us" title="Contact Us">
                            <a href="{ ! ! route('admin_contactus_all') !!}">
                                <i class="fa fa-wechat"></i>
                                    <span class="nav-label">Contact Us</span>
                                    <span class="label label-info pull-right">{{$admin->unread_contact_us}}</span>
                            </a>
                        </li>


                        <li id="conflicts_all" title="Conflicts & Returns">
                            <a href="{ ! ! route('admin_conflicts_all') !!}">
                                <i class="fa fa-bullhorn"></i>
                                    <span class="nav-label">Conflicts & Returns</span>
                                    <span class="label label-info pull-right">{{$admin->unread_conflicts}}</span>
                            </a>
                        </li>

<!--                 <li>
                    <a href="css_animation.html"><i class="fa fa-magic"></i> <span class="nav-label">CSS Animations </span><span class="label label-info pull-right">62</span></a>
                </li> -->

                        <li id="settings_all" title="Settings" onclick="javascript:location.href='#' ">
                                <a href="#">
                                    <i class="fa fa-wrench"></i>
                                        <span class="nav-label">Settings</span>
                                        <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" style="height: 0px;">

                                    <li id="categories_all" title="Categories">
                                        <a href="{ ! ! route('admin_category_all') !!}">
                                            <i class="fa fa-braille"></i>
                                                <span class="nav-label">Categories</span>
                                        </a>
                                    </li>

                                    <li id="banners_all">
                                        <a href="{ { route('admin_banner_all')}}" title="Banners">
                                            <i class="fa fa-windows"></i> Banners
                                        </a>
                                    </li>

                                    <li id="coupons_all">
                                        <a href="{ { route('admin_coupons_all')}}" title="Coupons">
                                            <i class="fa fa-creative-commons"></i> Coupons
                                        </a>
                                    </li>

                                    <li id="pages_all">
                                        <a href="{ { route('admin_page_all')}}" title="Pages">
                                            <i class="fa fa-file"></i> Pages
                                        </a>
                                    </li>

                                </ul>
                        </li>

                        <li id="push_notifications" title="Push Notifications">
                            <a href="{ ! ! route('push_notifications_get') !!}">
                                <i class="fa fa-mobile"></i>
                                    <span class="nav-label">Push Notifications</span>
                            </a>
                        </li>

            </ul>

        </div>
    </nav>

<div id="page-wrapper" class="gray-bg">
    
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a id="demo331" class="demo331">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>
                </ul>

            </nav>
        </div>

        @foreach($errors->all() as $error)
            <div class="alert alert-dismissable alert-danger">
                {!! $error !!}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
        @endforeach

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    @yield('content')

</div>



    <script src="/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/admin/js/inspinia.js"></script>
    <script src="/admin/js/plugins/pace/pace.min.js"></script>
    <script src="/admin/js/plugins/toastr/toastr.min.js"></script>
    <!-- blueimp gallery -->
    <script src="/admin/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
    <!-- Idle Timer plugin -->
    <!-- <script src="/admin/js/plugins/idle-timer/idle-timer.min.js"></script> -->


    <script src="/admin/js/my_validation.js"></script>

    <script>


         function removeSpaces(value)
            {
                return value.replace(/^\s+|\s+$/g,"");
            }

            $(document).ready(function() 
                {
                    ///////////////////////////////////  Logout Function /////////////////////////////////////////////////
                    $('.demo331').click(function () 
                        {

                            swal({ 
                             title: "Are you sure?",
                                    text: "You want to logout!",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Yes, Logout!",
                                    closeOnConfirm: false
                              },
                              function(){
                                window.location.href = '{ { route('admin_logout')}}';
                            });

                        });
                    ///////////////////////////////////////         Toaster  //////////////////////////////////////////////////
                    
                    // $( document ).idleTimer(120000);

                    // $(document).bind("idle.idleTimer", function(){
                    //     window.location.href = '{ { route("admin_logout")}}';
                    // });

                });

    </script>

</div>
                   
        <div id="blueimp-gallery" class="blueimp-gallery">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>

</body>

</html>