@extends('layouts.Admin.dashboard')
@if(isset($banner))
@section('title', __('admin_banner.v_banner'))
@else
@section('title', __('admin_banner.v_banner'))
@endif

@section('content')  
<link rel="stylesheet" href="{{ asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/node_modules/lightgallery/dist/css/lightgallery.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/dist/bootstrap-tagsinput.css') }}">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">@if(isset($banner)){{ __('admin_banner.v_banner') }}@else {{ __('admin_banner.v_banner') }} @endif</h4>
                    </div> 
                    <div class="col-6">
                        <p class="page-description"><a style="float: right;" href="{{ route('admin_banner_all') }}" class="btn btn-primary">{{ __('buttons.back')}}</a></p> 
                    </div>
                </div> 
                <div class='row'>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card text-center">
                            <div class="card-body">                              
                            <p class="text-muted"></p>
                            <p class="mt-4 card-text">                        
                              <div id="lightgallery-without-thumb" class="lightGallery" >
                                <a href="{{asset('/uploads/admin_images/'.$banner->img)}}" class="image-tile">
                                    <img src="{{asset('/uploads/admin_images/'.$banner->img)}}" alt="image small" style="max-width: 100%"/>
                                </a> 
                              </div> 
                            </p>
                            <p class="mt-4 card-text">        
                                {!! isset($banner->description)?$banner->description :'' !!}
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('admin_banner.other_details')}}</h4>
                                <ul class="bullet-line-list">
                                      <li>
                                        <h6>{{__('admin_banner.title')}}</h6>
                                        <p class="mb-0">{{ isset($banner->title)?$banner->title  :'' }}</p>
                                        <p class="text-muted">
                                            <!--<i class="mdi mdi-clock"></i>
                                            7 months ago.-->
                                        </p>
                                    </li>
                                    <li>
                                        <h6>{{__('admin_banner.s_date')}}</h6>
                                        <p class="mb-0">{{ isset($banner->start_date)?$banner->start_date  :'' }}</p>
                                        <p class="text-muted">
                                            <!--<i class="mdi mdi-clock"></i>
                                            7 months ago.-->
                                        </p>
                                    </li>
                                    <li>
                                        <h6>{{__('admin_banner.e_date')}}</h6>
                                        <p class="mb-0">{{ isset($banner->end_date)?$banner->end_date :'' }}</p>
                                        <p class="text-muted"> 
                                        </p>
                                    </li> 
                                    <li>
                                        <h6>{{__('admin_banner.sequence')}}</h6>
                                        <p class="mb-0">{{ isset($banner->sequence)?$banner->sequence :'' }}</p>
                                        <p class="text-muted"> 
                                        </p>
                                    </li> 
                                </ul>
                            </div>
                            
                        </div>
                    </div>

                  
                </div>
            </div>

        </div>
    </div>
</div>   
<script>  
    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };


    function initAutocomplete() {
        var geocoder = new google.maps.Geocoder;
        geocodeLatLng(geocoder); 
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});
 
        autocomplete.addListener('place_changed', fillInAddress);
        var input = document.getElementById('autocomplete');
        google.maps.event.addDomListener(input, 'keydown', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
            }
        });
    }

    function fillInAddress() { 
        var place = autocomplete.getPlace();

        if (!place.geometry) {
            $('#latitude').val('');
            $('#longitude').val('');
        }
 
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#latitude').val(lat);
        $('#longitude').val(lng);
        $('#address').val($('#autocomplete').val());
        $('#autocomplete').attr('disabled', 'disabled'); 
    }
    function geocodeLatLng(geocoder) {
        var latlng = {lat: parseFloat($('#latitude').val()), lng: parseFloat($('#longitude').val())};
        console.log(latlng);
        geocoder.geocode({'location': latlng}, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    // console.log(results[0].formatted_address);
                    $('#address').val(results[0].formatted_address);
                    $('#autocomplete').val(results[0].formatted_address);
                } else {
                    $('#address').val('');
                }
            } else {
                $('#address').val('');
            }
        });
    }
</script>
<script src="{{ asset('admin/node_modules/lightgallery/dist/js/lightgallery-all.min.js') }}"></script>
<script src="{{ asset('admin/js/light-gallery.js') }}"></script> 
<script src="{{ asset('admin/js/file-upload.js') }}"></script>  
@endsection
