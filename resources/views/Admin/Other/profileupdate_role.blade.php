@extends('layouts.Admin.dashboard')
@section('title', __('admin_dashboard.p_update'))
@section('content')

<link rel="stylesheet" href="{{ asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/dist/bootstrap-tagsinput.css') }}">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{__('admin_dashboard.p_update')}}</h4>   
                    @php  $user = $admin; @endphp
                 <form class="forms-sample" method="post" action="{{route('admin_user_update')}}" enctype="multipart/form-data" id="form"> 
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="address" id="address" value="{{ isset($user->userDetails)?$user->userDetails->address : Request::old('address') }}" />
                        <input type="hidden" name="latitude" id="latitude" value="{{ isset($user->userDetails)?$user->userDetails->latitude : Request::old('latitude') }}" />
                        <input type="hidden" name="longitude" id="longitude" value="{{ isset($user->userDetails)?$user->userDetails->longitude : Request::old('longitude') }}" />
                            
                            
                        <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_dashboard.name') }}</label>
                            <input name="name" value="{{ isset($user->name)?$user->name  : Request::old('name') }}" type="text" class="form-control" id="name" placeholder="{{ __('admin_dashboard.name') }}" max="150" required='required'/>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputName3">{{ __('login.email') }}</label>
                            <input name="email" value="{{ isset($user->email)?$user->email :Request::old('email') }}" type="email" class="form-control" id="email" placeholder="{{ __('login.email') }}" />
                        </div>
                            
                         <div class="form-group">
                            <label for="exampleInputName3">{{ __('admin_user.c_number') }}</label>
                            <input name="phone" value="{{ isset($user->phone)?$user->phone :Request::old('phone') }}" type="text"  class="form-control" id="phone" placeholder="{{ __('admin_user.c_number') }}" />
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
            <!--             <div class="form-group">
                            <label for="exampleInputName3">{ { __('admin_user.role') } }</label>
                            <select  class="form-control" id="role" name="role" required='required' >
                              <option value=''>{ { __('admin_user.select_one_role') } }</option>
                              @ if(is_object($roles))
                                @ foreach($roles as $key=>$value)
                                   <option value='{ { $value } }' @ if(in_array($value,$role_array)){ { "selected=selected" } }@ endif>{ { __('admin_user.'.$value) } }</option>
                                @ endforeach 
                              @ endif
                            </select> 
                        </div> -->
                         <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_user.flat_n') }}</label>
                            <input name="flat_no" value="{{ isset($user->userDetails)?$user->userDetails->flat_no : Request::old('b_flat_no') }}" type="text" class="form-control" id="exampleInputName1" placeholder="{{ __('admin_user.flat_n') }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">{{ __('admin_user.address') }}</label>
                            <input id="autocomplete" name="b_address1" value="{{ isset($user->userDetails)?$user->userDetails->address : Request::old('address') }}" type="text" class="form-control"   placeholder="{{ __('admin_user.address') }}" required="required"/> 
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
            </div>

        </div>
    </div>
</div>
<script src="/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="{{ asset('admin/js/file-upload.js') }}"></script> 
    <script type="text/javascript">

        $("#dashboard").addClass("active");

        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 200
                },
                job: {
                    required: true,
                    maxlength: 200
                },
                image: {
                    accept: "image/*"
                }
            },
            messages: {
                name: {
                    required: "Please enter name",
                },
                job: {
                    required: "Please enter job",
                },
                image:
                        {
                            accept: "Only Image is allowed"
                        }
            }
        });

    </script>


@stop



