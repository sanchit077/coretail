@extends('layouts.Admin.dashboard')
@if(isset($user))
@section('title', __('admin_user.v_user'))
@else
@section('title', __('admin_user.v_user'))
@endif

@section('content')  
<link rel="stylesheet" href="{{ asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/dist/bootstrap-tagsinput.css') }}">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">@if(isset($user)){{ __('admin_user.v_user') }}@else {{ __('admin_user.v_user') }} @endif</h4>
                    </div> 
                    <div class="col-6">
                        <p class="page-description"><a style="float: right;" href="{{ route('admin_b_user_all') }}" class="btn btn-primary">{{ __('buttons.back')}}</a></p> 
                    </div>
                </div>
                <div class='row'>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card text-center">
                            <div class="card-body">
                                <img src="{{asset('admin/images/faces/face10.jpg')}}" alt="image" class="img-lg rounded-circle mb-2" />
                                <h4>{{ isset($user->name)?$user->name  :'' }}</h4>
                                <p class="text-muted">{{ isset($user->email)?$user->email  :'' }}</p>
                                <p class="mt-4 card-text"></p>
                                <!--<button class="btn btn-info btn-sm mt-3 mb-4">Follow</button>-->
                            <!--    <div class="border-top pt-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>{ { isset($user->reviews_count)?$user->reviews_count  :0 }}</h6>
                                            <p>Reviews</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>{ { isset($user->followers_count)?$user->followers_count  :0 }}</h6>
                                            <p>Followers</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>{ { isset($user->following_count)?$user->following_count  :0 }}</h6>
                                            <p>Following</p>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('admin_user.p_info')}}</h4>
                                <ul class="bullet-line-list">
                                    <li>
                                        <h6>{{__('admin_dashboard.job')}}</h6>
                                        <p class="mb-0">{{ isset($user->job)?$user->job  :'' }}</p>
                                        <p class="text-muted">
                                            <!--<i class="mdi mdi-clock"></i>
                                            7 months ago.-->
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
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
        var input = document.getElementById('autocomplete');
        google.maps.event.addDomListener(input, 'keydown', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
            }
        });
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        if (!place.geometry) {
            $('#latitude').val('');
            $('#longitude').val('');
        }

        /* for (var component in componentForm) {
         document.getElementById(component).value = '';
         document.getElementById(component).disabled = false;
         }*/
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#latitude').val(lat);
        $('#longitude').val(lng);
        $('#address').val($('#autocomplete').val());
        $('#autocomplete').attr('disabled', 'disabled');
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        /*    for (var i = 0; i < place.address_components.length; i++) {
         var addressType = place.address_components[i].types[0];
         if (componentForm[addressType]) {
         var val = place.address_components[i][componentForm[addressType]];
         document.getElementById(addressType).value = val;
         }
         }*/
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
<script src="https://maps.googleapis.com/maps/api/js?key={{env('google_place_api_key')}}&libraries=places&callback=initAutocomplete"   async defer></script>
<script src="{{ asset('admin/js/file-upload.js') }}"></script>  
@endsection
