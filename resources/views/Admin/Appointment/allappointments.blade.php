@extends('layouts.Admin.dashboard')
@section('title',__('admin_appointment.all_appointments'))
@section('content')
  <link href="{{ asset('/frontend/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/node_modules/lightgallery/dist/css/lightgallery.min.css') }}" /> 
  <script type="text/javascript">
    function addFilter(val){  
        window.location.href ="{{route('admin_appointments_all')}}?daterange="+$('#daterange').val()+"&s="+val; 
    }
  </script>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{__('admin_appointment.all_appointments')}}</h4>          
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
                        <a href="{{route('admin_appointments_all')}}">
                          <button class="btn btn-success mr-2" tabindex="0" aria-controls="example" ><span>Reset</span></button>
                        </a>                  
                      </div>
                  
                    <div class="col-lg-4 col-md-4 col-sm-4"> 
                        <div class="form-group">
                            <label class="pull-left">Status</label>
                              <select class="form-control" name="status" id="status"  onchange="addFilter(this.value);">  <option value="all">All</option> 
                                  <option @if(isset($_GET['s']) && $_GET['s']=='pending'){{ 'selected=selected' }}@endif value="pending">Pending</option> 
                                  <option @if(isset($_GET['s']) && $_GET['s']=='failed'){{ 'selected=selected' }}@endif  value="failed">Failed</option> 
                                  <option @if(isset($_GET['s']) && $_GET['s']=='closed'){{ 'selected=selected' }}@endif  value="closed">Closed</option> 
                              </select>
                        </div>
                    </div> 
                 <div class="col-lg-2 col-md-2 col-sm-2"> <br />
                        
                  </div>
              </div>   
           


                <div class="row"> 
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                        <table id="sortable-table-2" class="table table-striped">
                            <thead>
                                <tr> 
                                  <th>{{__('admin_user.id')}}</th>
                                  <th>{{__('admin_appointment.name')}}</th>  
                                  <th>{{__('admin_appointment.phone')}}</th>  
                                  <th>{{__('admin_appointment.call_date')}}</th>   
                                  <th>{{__('admin_appointment.call_time')}}</th>   
                                  <th>{{__('admin_user.created_at')}}</th> 
                                  <!-- <th>{ {__('admin_application.status')} }</th>   -->
                                  <th>{{__('buttons.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($appointments)>0) 
                                  @csrf
                                @foreach($appointments as $application) 
                                <tr> 
                                    <td class="center">{{ $application->id }}</td>
                                    <td>{{ $application->name }}</td> 
                                    <td>{{ $application->phone }}</td>  

                                    <td>{{ $application->call_date }}</td> 
                                    <td>{{ $application->call_time }}</td>   
                                    <td class="center">{{ date('d-M-Y', strtotime($application->created_at)) }}</td>
                    
                                    <td>
                                      <select class="form-group" id="appointment_status" name="appointment_status"   onchange="changeStatus({{ $application->id }});">
                                        <option @if(isset($application->status) && $application->status=='pending') {{ 'selected=selected'}}@endif value="pending">Pendiente</option>
                                        <option @if(isset($application->status) && $application->status=='failed') {{ 'selected=selected'}} @endif value="failed">Ha Fallado</option>
                                        <option @if(isset($application->status) && $application->status=='closed') {{ 'selected=selected'}}@endif value="closed">Cerrado</option>
                                      </select>
                                    </td> 
                                </tr>
                                @endforeach
                                @endif  
                            </tbody>
                        </table>
                    </div>                     
                </div>
            </div>
            <div class="page_custom">{{ $appointments->links() }}</div> 
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

   function changeStatus(id){  
        if(id!=''){
            if(confirm('{{__("admin_request.sure_update_status")}}')){
               update_status(id);        
            }
        }
    }
    function update_status(id){  
      var data = {  appointment_id: id, statusVal: $('#appointment_status').val()}; 
      $.ajax({
           headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
            type: "POST",
            url: "{{ route('apppointment_status_update_admin') }}",
            data: data,
            // contentType: "application/json; charset=utf-8",
            // dataType: "json",
            success: function(status) {
               if(status.success==1) 
                 alert(status.msg);
                 // window.location.href = "{{ route('approved_request_all')}}";
            },
            error:function(xhr, errorType, exception){
               responseText = jQuery.parseJSON(xhr.responseText); 
               alert(responseText.msg );
            }
      });
   }      

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
            var newURL  =   "{{route('admin_appointments_all')}}?daterange="+encodeURI(startDate+' - '+endDate);
            window.location.href=newURL+"&s="+$('#status :selected').val();; 
        });   
   //update_states

</script>   
@endsection