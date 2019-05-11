@extends('layouts.Admin.dashboard')
@if(isset($user))
@section('title', __('admin_user.u_user'))
@else
@section('title', __('admin_user.a_n_user'))
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
                  <h4 class="card-title">@if(isset($user)){{ __('admin_user.u_user') }}@else {{ __('admin_user.a_n_user') }} @endif</h4>
                        </div> 
                        <div class="col-6">
                            <p class="page-description"><a style="float: right;" href="{{ route('admin_user_all') }}" class="btn btn-primary">{{ __('buttons.back') }}</a></p> 
                        </div>
                    </div>   
                <p class="card-description"></p>
                
                @if(isset($user))
                <form class="forms-sample" method="post" action="{{route('admin_user_update')}}" enctype="multipart/form-data" id="form"> 
                    <input type="hidden" name="id" value="{{ $user->id }}">
                @else
                <form class="forms-sample" method="post" action="{{route('admin_user_add_post')}}" enctype="multipart/form-data" id="form">  
                @endif
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
                        <div class="form-group">
                            <label for="exampleInputName3">{{ __('admin_user.role') }}</label>
                            <select  class="form-control" id="role" name="role" required='required' >
                              <option value=''>{{ __('admin_user.select_one_role') }}</option>
                              @if(is_object($roles))
                                @foreach($roles as $key=>$value)
                                   <option value='{{ $value }}' @if(in_array($value,$role_array)){{ "selected=selected" }}@endif>{{ __('admin_user.'.$value) }}</option>
                                @endforeach
                              @endif
                            </select> 
                        </div>
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
                <hr />
             
            </div>

        </div>
    </div>
</div>  

<!-- <script src="{{ asset('admin/node_modules/typeahead.js/dist/typeahead.bundle.min.js') }}"></script>  -->
<script src="{{ asset('admin/node_modules/select2/dist/js/select2.min.js') }}"></script> 
<!-- <script src="{{ asset('admin/js/typeahead.js') }}"></script>  -->
<script src="{{ asset('admin/js/select2.js') }}"></script> 
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
        google.maps.event.addDomListener(input, 'keydown', function(event) { 
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
            $('#autocomplete').attr('disabled','disabled');
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
        geocoder.geocode({'location': latlng}, function(results, status) {
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
