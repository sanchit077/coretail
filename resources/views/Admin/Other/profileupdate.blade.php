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

                <form class="forms-sample" method="post" action="{{route('aprofile_update_post')}}" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="exampleInputName1">{{__('admin_dashboard.name')}}</label>
                        <input type="text" placeholder="{{__('admin_dashboard.name')}}" autocomplete="off" class="form-control" required onblur="this.value = removeSpaces(this.value)" name="name" value="{!! $admin->name !!}" autofocus="on" id="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">{{__('admin_dashboard.job')}}</label>
                        <input type="text" placeholder="{{__('admin_dashboard.job')}}" autocomplete="off" class="form-control" required onblur="this.value = removeSpaces(this.value)" name="job" value="{!! $admin->job !!}" id="job">
                    </div>
                    <div class="form-group">
                        <label>{{__('admin_dashboard.profile_pic')}}</label>
                        <input type="file" name="profile_pic" class="file-upload-default" />
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="{{__('admin_dashboard.upload_img')}}" />
                            <span class="input-group-btn">
                                <button class="file-upload-browse btn btn-info" type="button">{{__('admin_dashboard.browse')}}</button>
                            </span>
                        </div>
                    </div> 

                    {!! Form::submit(__('admin_dashboard.update_p'), ['class' => 'btn btn-success mr-2']) !!}
                    {!! Form::reset(__('admin_dashboard.reset'), ['class' => 'btn btn-primary']) !!}


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



