@extends('layouts.Admin.dashboard')
@if(isset($blog))
@section('title', __('admin_blog.u_blog'))
@else
@section('title', __('admin_blog.a_n_blog'))
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
                  <h4 class="card-title">@if(isset($blog)){{ __('admin_blog.u_blog') }}@else {{ __('admin_blog.a_n_blog') }} @endif</h4>
                        </div> 
                        <div class="col-6">
                            <p class="page-description"><a style="float: right;" href="{{ route('admin_blog_all') }}" class="btn btn-primary">{{ __('buttons.back') }}</a></p> 
                        </div>
                    </div>   
                <p class="card-description"></p>
                
                @if(isset($blog))
                <form class="forms-sample" method="post" action="{{route('admin_blog_update')}}" enctype="multipart/form-data" id="form"> 
                    <input type="hidden" name="id" value="{{ $blog->id }}">
                @else
                <form class="forms-sample" method="post" action="{{route('admin_blog_add_post')}}" enctype="multipart/form-data" id="form">  
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_banner.title') }}</label>
                            <input name="title" value="{{ isset($blog->title)?$blog->title  : Request::old('title') }}" type="text" class="form-control" id="title" placeholder="{{ __('admin_banner.title') }}" max="150" required='required'/>
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
                            <textarea id="editor1" name="description" class="form-control"   placeholder="{{ __('admin_banner.description') }}" required="required">{{ isset($blog->description)?$blog->description : Request::old('description') }}</textarea>
                        </div>

                <button type="submit" class="btn btn-success mr-2">{{ __('buttons.submit') }}</button>
                <button type="button" onClick="this.form.reset()" class="btn btn-light">{{ __('buttons.cancel') }}</button>
                         
                </form>
                <hr />  

            </div>

        </div>
    </div>
</div>   
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script> 
<!-- <script src="{ { asset('admin/node_modules/typeahead.js/dist/typeahead.bundle.min.js') }}"></script>  -->
<script src="{{ asset('admin/node_modules/select2/dist/js/select2.min.js') }}"></script> 
<!-- <script src="{ { asset('admin/js/typeahead.js') }}"></script>  --> 
<script src="{{ asset('admin/js/select2.js') }}"></script>  
<script> 
    CKEDITOR.replace( 'editor1' );
     
</script> 

<script src="{{ asset('admin/js/file-upload.js') }}"></script>  
@endsection
