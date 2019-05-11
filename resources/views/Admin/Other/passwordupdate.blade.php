@extends('layouts.Admin.dashboard')
@section('title', __('admin_dashboard.pass_update'))
@section('content')
<link rel="stylesheet" href="{{ asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/dist/bootstrap-tagsinput.css') }}">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ __('admin_dashboard.pass_update') }}</h4> 
                <form class="forms-sample" method="post" action="{{route('apassword_update_post')}}"  id="form">  
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="exampleInputName1">{{ __('admin_dashboard.old_p') }}</label>
                        <input type="password" placeholder="{{ __('admin_dashboard.old_p') }}" autocomplete="off" class="form-control" required onblur="this.value = removeSpaces(this.value)" name="old_password" autofocus="on" id="old_password">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">{{ __('admin_dashboard.new_p') }}</label>
                        <input type="password" placeholder="{{ __('admin_dashboard.new_p') }}" autocomplete="off" class="form-control" required onblur="this.value = removeSpaces(this.value)" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">{{ __('admin_dashboard.pass_c') }}</label>
                        <input type="password" placeholder="{{ __('admin_dashboard.pass_c') }}" autocomplete="off" class="form-control" required onblur="this.value = removeSpaces(this.value)" name="password_confirmation" id="password_confirmation">
                    </div>
                    {!! Form::submit(__('admin_dashboard.update_pass'), ['class' => 'btn btn-success mr-2']) !!}
                    {!! Form::reset(__('admin_dashboard.reset'), ['class' => 'btn btn-primary']) !!}


                </form>
            </div>

        </div>
    </div>
</div>


<script src="/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script type="text/javascript">

                            $("#dashboard").addClass("active");

                            $("#form").validate({
                                rules: {
                                    old_password: {
                                        required: true
                                    },
                                    password: {
                                        required: true,
                                    },
                                    password_confirmation: {
                                        equalTo: "#password"
                                    }
                                },
                                messages: {
                                    old_password: {
                                        required: "Old password is required",
                                    },
                                    password: {
                                        required: "New password is required",
                                    },
                                    password_confirmation: {
                                        required: "New Password Confirmation is required",
                                        equalTo: "New Password Confirmation do not match",
                                    }
                                }
                            });

</script>


@stop



