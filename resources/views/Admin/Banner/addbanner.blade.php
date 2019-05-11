@extends('layouts.Admin.dashboard')
@if(isset($user))
@section('title', __('admin_banner.u_banner'))
@else
@section('title', __('admin_banner.a_n_banner'))
@endif

@section('content')  
<link rel="stylesheet" href="{{ asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/dist/bootstrap-tagsinput.css') }}">

<link rel="stylesheet" href="{{ asset('admin/node_modules/icheck/skins/all.css') }}" />  
<link rel="stylesheet" href="{{ asset('admin/node_modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                  <div class="row">
                        <div class="col-6">
                  <h4 class="card-title">@if(isset($banner)){{ __('admin_banner.u_banner') }}@else {{ __('admin_banner.a_n_banner') }} @endif</h4>
                        </div> 
                        <div class="col-6">
                            <p class="page-description"><a style="float: right;" href="{{ route('admin_banner_all') }}" class="btn btn-primary">{{ __('buttons.back') }}</a></p> 
                        </div>
                    </div>   
                <p class="card-description"></p>
                
                @if(isset($banner))
                <form class="forms-sample" method="post" action="{{route('admin_banner_update')}}" enctype="multipart/form-data" id="form"> 
                    <input type="hidden" name="id" value="{{ $banner->id }}">
                @else
                <form class="forms-sample" method="post" action="{{route('admin_banner_add_post')}}" enctype="multipart/form-data" id="form">  
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_banner.title') }}</label>
                            <input name="title" value="{{ isset($banner->title)?$banner->title  : Request::old('title') }}" type="text" class="form-control" id="title" placeholder="{{ __('admin_banner.title') }}" max="150" required='required'/>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputName3">{{ __('admin_banner.url') }}</label>
                            <input name="url" value="{{ isset($banner->url)?$banner->url :Request::old('url') }}" type="text" class="form-control" id="email" placeholder="{{ __('admin_banner.url') }}" />
                        </div>                            
                         <div class="form-group">
                            <label for="exampleInputName3">{{ __('admin_banner.s_date') }}</label>
                            <input name="start_date" value="{{ isset($banner->start_date)?$banner->start_date :Request::old('start_date') }}" type="text"  class="form-control date_input" id="start_date" placeholder="{{ __('admin_banner.s_date') }}" data-inputmask="'alias': 'datetime'" />
                        </div>
                      
                         <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_banner.e_date') }}</label>
                            <input name="end_date" value="{{ isset($banner->end_date)?$banner->end_date : Request::old('end_date') }}" type="text" class="form-control date_input" id="end_date" placeholder="{{ __('admin_banner.e_date') }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_banner.sequence') }}</label>
                            <input id="sequence" name="sequence" value="{{ isset($banner->sequence)?$banner->sequence : Request::old('sequence') }}" type="text" class="form-control"   placeholder="{{ __('admin_banner.sequence') }}" required="required"/> 
                        </div>
                   
                        <div class="form-group">
                            <label>{{ __('admin_banner.img') }}</label>
                            <input type="file" name="img" class="file-upload-default" />
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{ __('admin_banner.img') }}" />
                                <span class="input-group-btn">
                                    <button class="file-upload-browse btn btn-info" type="button">{{ __('admin_dashboard.browse') }}</button>
                                </span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_banner.description') }}</label>
                            <textarea id="editor1" name="description" class="form-control"   placeholder="{{ __('admin_banner.description') }}" required="required">{{ isset($banner->description)?$banner->description : Request::old('description') }}</textarea>
                        </div>

                <button type="submit" class="btn btn-success mr-2">{{ __('buttons.submit') }}</button>
                <button type="button" onClick="this.form.reset()" class="btn btn-light">{{ __('buttons.cancel') }}</button>
                         
                </form>
                <hr /> 
             <!--
<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> 
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>    
    <div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker({ 
                });
            });
        </script>
    </div>
</div>-->

            </div>

        </div>
    </div>
</div>   
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script> 
<!-- <script src="{ { asset('admin/node_modules/typeahead.js/dist/typeahead.bundle.min.js') }}"></script>  -->
<script src="{{ asset('admin/node_modules/select2/dist/js/select2.min.js') }}"></script> 
<!-- <script src="{ { asset('admin/js/typeahead.js') }}"></script>  --> 
<script src="{{ asset('admin/js/select2.js') }}"></script> 
<script src="{{ asset('admin/js/jquery.inputmask.bundle.js') }}"></script>
<script> 
    CKEDITOR.replace( 'editor1' );
    (function($){ 
    //$('.date_input').val(new Date());      
          $('.date_input').inputmask("datetime",{
         //   mask: "1-2-y h:s", 
                mask: "1-2-y", 
          //  placeholder: "dd-mm-yyyy hh:mm", 
                placeholder: "dd-mm-yyyy", 
            leapday: "-02-29", 
            separator: "-", 
            alias: "dd-mm-yyyy"
          });       
    })(jQuery)
</script> 

<script src="{{ asset('admin/js/file-upload.js') }}"></script>  
@endsection
