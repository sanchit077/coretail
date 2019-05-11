@extends('layouts.Admin.dashboard')
@if(isset($user))
@section('title', __('admin_user.u_sadmin_user'))
@else
@section('title', __('admin_user.superadmin'))
@endif

@section('content')  
<link rel="stylesheet" href="{{ asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/dist/bootstrap-tagsinput.css') }}">

<link rel="stylesheet" href="{{ asset('admin/node_modules/icheck/skins/all.css') }}" />  
<link rel="stylesheet" href="{{ asset('admin/node_modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                  <div class="row">
                        <div class="col-6">
                  <h4 class="card-title">@if(isset($user)){{ __('admin_user.u_sadmin_user') }}@else {{ __('admin_user.add_new')  }} @endif</h4>
                        </div> 
                        <div class="col-6">
                            <p class="page-description"><a style="float: right;" href="{{ route('admin_b_user_all') }}" class="btn btn-primary">{{ __('buttons.back') }}</a></p> 
                        </div>
                    </div>   
                <p class="card-description"></p>
                
                @if(isset($user))
                <form class="forms-sample" method="post" action="{{route('admin_b_user_update')}}" enctype="multipart/form-data" id="form"> 
                    <input type="hidden" name="id" value="{{ $user->id }}">
                @else
                <form class="forms-sample" method="post" action="{{route('admin_b_user_add_post')}}" enctype="multipart/form-data" id="form">  
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       
                            
                        <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_dashboard.name') }}</label>
                            <input name="name" value="{{ isset($user->name)?$user->name  : Request::old('name') }}" type="text" class="form-control" id="name" placeholder="{{ __('admin_dashboard.name') }}" max="150" required='required'/>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputName3">{{ __('login.email') }}</label>
                            <input name="email" value="{{ isset($user->email)?$user->email :Request::old('email') }}" type="email" class="form-control" id="email" placeholder="{{ __('login.email') }}" />
                        </div> 
                       
                        @if(isset($user))
                        <div class="form-group">
                            <label for="exampleInputName3">{{ __('login.password') }}</label>
                            <input name="password" value="" type="password" class="form-control" id="Password" placeholder="{{ __('login.password') }}" />
                        </div>
                        @else
                          <div class="form-group">
                            <label for="exampleInputName3">{{ __('login.password') }}</label>
                            <input name="password" value="" type="password" class="form-control" id="Password" placeholder="{{ __('login.password') }}" required='required' />
                        </div>
                        @endif 
                         <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_dashboard.job') }}</label>
                            <input name="job" value="{{ isset($user->job)?$user->job  : Request::old('job') }}" type="text" class="form-control" id="job" placeholder="{{ __('admin_dashboard.job') }}" max="150" />
                        </div> 
                        <div class="form-group">
                            <label>{{ __('admin_dashboard.profile_pic') }}</label>
                            <input type="file" name="profile_pic" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{ __('admin_dashboard.upload_img') }}" />
                                <span class="input-group-btn">
                                    <button class="file-upload-browse btn btn-info" type="button">{{ __('admin_dashboard.browse') }}</button>
                                </span>
                            </div>
                        </div>

                <button type="submit" class="btn btn-success mr-2">{{ __('buttons.submit') }}</button>
                <button type="button" onClick="this.form.reset()" class="btn btn-light">{{ __('buttons.cancel') }}</button>
                         
                </form>
                <hr />
             
            </div>

        </div>
    </div>
</div>  

<script src="{{ asset('admin/node_modules/typeahead.js/dist/typeahead.bundle.min.js') }}"></script> 
<script src="{{ asset('admin/node_modules/select2/dist/js/select2.min.js') }}"></script> 
<script src="{{ asset('admin/js/typeahead.js') }}"></script> 
<script src="{{ asset('admin/js/select2.js') }}"></script>  

<script src="{{ asset('admin/js/file-upload.js') }}"></script>  
@endsection
