@extends('layouts.Admin.dashboard')
@section('title', __('admin_dashboard.all_users'))
@section('content')
<!-- Data Tables -->  
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{__('admin_dashboard.all_users')}}</h4>          
                    </div> 
                    <div class="col-6">
  <p class="page-description"><a style="float: right;" href="{{ route('admin_user_add_get')}}" class="btn btn-primary">{{ __('admin_dashboard.create_new_u') }}</a></p> 
                    </div>
                </div>


                <div class="row">
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                        <table id="sortable-table-2" class="table table-striped">
                            <thead>
                                <tr> 
                                    <th>{{__('admin_user.id')}}</th>
                                    <th>{{__('admin_dashboard.name')}}</th> 
                                    <th>{{__('login.email')}}</th> 
                                    <th>{{__('admin_user.phone')}}</th>  
                                    <th>{{__('admin_user.social_login')}}</th>  
                                    <th>{{__('admin_user.created_at')}}</th>  
                                    <th>{{__('buttons.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users)>0) 
                                @foreach($users as $user) 
                                <tr> 
                                    <td class="center">{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td> 
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>@if($user->total_social>0) {{'Yes'}} @else {{ 'No' }}  @endif</td>
                                    <td class="center">{{ date('d-M-Y', strtotime($user->created_at)) }}</td>
                                    <td> <a title="{{__('buttons.edit')}}" href="{{ route('admin_user_edit',$user->id  ) }}" target="blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                        <a title="{{__('buttons.delete')}}" onclick="return confirm('{{__("admin_user.sure_delete_user")}}')" href="{{ route('admin_user_delete', $user->id ) }}" ><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a> | @if($user->status=='active')<a href="{{ route('admin_user_block', [$user->id , '1'] ) }}" title="{{__('buttons.block')}}" onclick="return confirm('{{__("admin_user.sure_block_user")}}')"><i class="fa fa-ban" aria-hidden="true"></i></a>@else<a href="{{ route('admin_user_block', [$user->id , '0'] ) }}" title="{{__('buttons.un_block')}}" onclick="return confirm('{{__("admin_user.sure_un_block_user")}}')"><i style="color:red" class="fa fa-ban" aria-hidden="true"></i></a>@endif | <a title="{{__('buttons.view')}}"  href="{{ route('admin_user_view',$user->id  ) }}" target="blank"><i class="fa fa-eye"></i></a>
                                    </td> 
                                </tr>
                                @endforeach
                                @endif  
                            </tbody>
                        </table>
                    </div>                     
                </div>
            </div>
            <div class="page_custom">{{ $users->links() }}</div>
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
<!-- Page-Level Scripts --> 
@endsection
