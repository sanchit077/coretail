@extends('layouts.Admin.dashboard')
@section('title',__('admin_application.all_applications'))
@section('content')
      <link href="{{ asset('/frontend/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet">


  <link rel="stylesheet" href="{{ asset('admin/node_modules/lightgallery/dist/css/lightgallery.min.css') }}" /> 
  <script type="text/javascript">
    function addFilter(val){  
        window.location.href ="{{route('admin_application_all')}}?daterange="+$('#daterange').val()+"&s="+val; 
    }
  </script>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{__('admin_application.all_applications')}}</h4>          
                    </div>  
                    <div class="col-6">
                        
                    </div>
                </div>
                 <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">                             
                        <label>
                            Filter By Registered At
                        </label>   
    <input date-range-picker id="daterange" name="daterange" class="form-control date-picker active" type="text" clearable="true" options="dateRangeOptions" value="{{$starting_dt}} - {{$ending_dt}}"/>                             
                        </div>
                      <div class="col-lg-2 col-md-2 col-sm-2">
                        <br>
                        <a href="{{route('admin_application_all')}}">
                          <button class="btn btn-success mr-2" tabindex="0" aria-controls="example" ><span>Reset</span></button>
                        </a>                  
                      </div>
                  
                    <div class="col-lg-4 col-md-4 col-sm-4"> 
                        <div class="form-group">
                            <label class="pull-left">Status</label>
                              <select class="form-control" name="status" id="status"  onchange="addFilter(this.value);">
                                    <option value="all">All</option> 
                                    <option @if(isset($_GET['s']) && $_GET['s']=='requested'){{ 'selected=selected' }}@endif value="requested">Requested</option> 
                                    <option @if(isset($_GET['s']) && $_GET['s']=='approved'){{ 'selected=selected' }}@endif  value="approved">Approved</option> 
                                    <option @if(isset($_GET['s']) && $_GET['s']=='unapproved'){{ 'selected=selected' }}@endif  value="unapproved">Unapproved</option> 
                                    <option @if(isset($_GET['s']) && $_GET['s']=='completed'){{ 'selected=selected' }}@endif  value="completed">Completed</option>                                    
                                    <option @if(isset($_GET['s']) && $_GET['s']=='incomplete'){{ 'selected=selected' }}@endif  value="incomplete">Incomplete</option> 
                                    <option @if(isset($_GET['s']) && $_GET['s']=='conditioned'){{ 'selected=selected' }}@endif  value="conditioned">Conditioned</option> 
                                    <option @if(isset($_GET['s']) && $_GET['s']=='cancelled'){{ 'selected=selected' }}@endif  value="cancelled">Cancelled</option> 
                                    <option @if(isset($_GET['s']) && $_GET['s']=='accepted'){{ 'selected=selected' }}@endif  value="accepted">Accepted</option>  
                              </select>
                        </div>
                    </div> 
                 <div class="col-lg-2 col-md-2 col-sm-2"> <br />
                       <a id="exportID" href="{{route('admin_application_export')}}?daterange={{$starting_dt}} - {{$ending_dt}}"><button class="btn btn-success mr-2" tabindex="0" aria-controls="example"><span>Excel Export</span></button></a>
                  </div>
              </div>   
           


                <div class="row"> 
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                        <table id="sortable-table-2" class="table table-striped">
                            <thead>
                                <tr> 
                                    <th>{{__('admin_user.id')}}</th>
                                    <th>{{__('admin_application.loan_id')}}</th>  
                                     <th>{{__('admin_application.user')}}</th>  
                                    <th>{{__('admin_application.asset_details')}}</th>   
                                    <th>{{__('admin_application.emi_details')}}</th>  
                                    <th>{{__('admin_application.sub_date')}}</th> 
                                     <th>{{__('admin_application.status')}}</th>  
                                    <th>{{__('buttons.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($applications)>0) 
                                @foreach($applications as $application) 
                                <tr> 
                                    <td class="center">{{ $application->id }}</td>
                                    <td>{{ $application->loan_id }}</td> 
                                    <td>@if(is_object($application->user) && is_object($application->user->userDetails))
                                        {{$application->user->name}}
                                      <!--   <div id="lightgallery-without-thumb" class="lightGallery" style="max-width:50px !important;"> 
                                            <a href="{ { $application->user->userDetails->profile_pic_url }}" class="image-tile">
                                                <img src="{ { $application->user->userDetails->profile_pic_url }}" alt="{{ $application->user->name}}" />
                                            </a> 
                                        </div> -->
                                    @else
                                        {{ 'No User' }}
                                    @endif                       
                                    </td>
                                    <td>
                                      @if(is_object($application->assets))
                                         {{$application->assets->vehicle_brand}} 
                                          <br /> {{$application->assets->vehicle_make}}  
                                    @endif
                                    </td>
                                    <td>{{ '$'.$application->emi_amount."-".$application->emi_term." months" }}</td>  
                                    <td class="center">{{ date('d-M-Y', strtotime($application->created_at)) }}</td>
                                     <td class="center">{{ ucfirst($application->status) }}</td>
  <td>  <a title="{{__('buttons.view')}}"  href="{{ route('admin_application_view',$application->id  ) }}" target="blank"><i class="fa fa-eye"></i></a>
                                    </td> 
                                </tr>
                                @endforeach
                                @endif  
                            </tbody>
                        </table>
                    </div>                     
                </div>
            </div>
            <div class="page_custom">{{ $applications->links() }}</div> 
        </div>
    </div> 

</div>
<!-- Data Tables -->
<style>
    .page_custom ul{
        float: right !important;
        text-align: right;
        margin-right: 3%;
        margin-top: -15px;
    } 
</style>
<script src="{{ asset('admin/js/jq.tablesort.js') }}"></script>
<script src="{{ asset('admin/js/tablesorter.js') }}"></script>
<script src="{{ asset('admin/node_modules/lightgallery/dist/js/lightgallery-all.min.js') }}"></script>
<script src="{{ asset('admin/js/light-gallery.js') }}"></script> 
 
<script src="{{ asset('/frontend/daterangepicker/moment.min.js')}}"></script>
<script src="{{ asset('/frontend/daterangepicker/daterangepicker.js')}}"></script>
          
<script> 
 
    $('input[name="daterange"]').daterangepicker({
        format: 'DD/MM/YYYY',
        minDate: '1/1/2019',
        opens: 'center',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default'
            });

    $('#daterange').on('apply.daterangepicker', function(ev, picker) 
        {
            var startDate   = picker.startDate.format('DD/MM/YYYY');
            var endDate     = picker.endDate.format('DD/MM/YYYY'); 
            
            // if(Request.QueryString["s"].ToString()!='undefined') {
            // var status  =   Request.QueryString["s"].ToString();
            // var newURL  =   "{{route('admin_application_all')}}?daterange="+encodeURI(startDate+' - '+endDate)+"&s="+status;
            // }               
            // else
            var newURL  =   "{{route('admin_application_all')}}?daterange="+encodeURI(startDate+' - '+endDate);
            window.location.href=newURL+"&s="+$('#status :selected').val();; 
        });   
   // $("#settings_all").addClass("active");
  //   $("#rides_all").addClass("active");      
          
      
  //   var table = $('#example').dataTable( {
  //       //order: [ 0, "asc" ],
  //       //paging:   false,
  //       ordering: false,
  //       info:false,
  //       fnDrawCallback: function( oSettings ) {
  //       },
  //     aoColumnDefs: [
  //               { "bSortable": true, "aTargets": [0] },
  //               { "bSearchable": true, "aTargets": [2,3,4] }
  //           ]            
  //   });    
  // $("#filter1").on('change', function()
  //   { 
  //     table.fnFilter($(this).val(), 1);
  //   });      
</script>   
@endsection