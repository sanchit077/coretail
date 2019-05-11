@extends('layouts.Admin.dashboard')
@section('title',__('admin_banner.all_banner'))
@section('content')
  <link rel="stylesheet" href="{{ asset('admin/node_modules/lightgallery/dist/css/lightgallery.min.css') }}" /> 
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{__('admin_banner.all_banner')}}</h4>          
                    </div> 
                    <div class="col-6">
  <p class="page-description"><a style="float: right;" href="{{ route('admin_banner_add_get')}}" class="btn btn-primary">{{ __('admin_banner.create_n_banner') }}</a></p> 
                    </div>
                </div>


                <div class="row">
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                        <table id="sortable-table-2" class="table table-striped">
                            <thead>
                                <tr> 
                                    <th>{{__('admin_user.id')}}</th>
                                    <th>{{__('admin_banner.title')}}</th> 
                                    <th>{{__('admin_banner.img')}}</th> 
                                    <th>{{__('admin_banner.s_date')}}</th>  
                                    <th>{{__('admin_banner.e_date')}}</th>  
                                    <th>{{__('admin_user.created_at')}}</th>  
                                    <th>{{__('buttons.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($banners)>0) 
                                @foreach($banners as $banner) 
                                <tr> 
                                    <td class="center">{{ $banner->id }}</td>
                                    <td>{{ $banner->title }}</td> 
                                    <td><div id="lightgallery-without-thumb" class="lightGallery" style="max-width:50px !important;">
                                            <a href="{{asset('/uploads/admin_images/'.$banner->img)}}" class="image-tile">
                                                <img src="{{ asset('uploads/admin_images/'.$banner->img) }}" />
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $banner->start_date }}</td>
                                    <td>{{ $banner->end_date }}</td> 
  <td class="center">{{ date('d-M-Y', strtotime($banner->created_at)) }}</td>
  <td> <a title="{{__('buttons.edit')}}" href="{{ route('admin_banner_edit',$banner->id  ) }}" target="blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                        <a title="{{__('buttons.delete')}}" onclick="return confirm('{{__("admin_banner.sure_delete_banner")}}')" href="{{ route('admin_banner_delete', $banner->id ) }}" ><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a> | @if($banner->status=='active')<a href="{{ route('admin_banner_block', [$banner->id , '1'] ) }}" title="{{__('buttons.block')}}" onclick="return confirm('{{__("admin_banner.sure_block_banner")}}')"><i class="fa fa-ban" aria-hidden="true"></i></a>@else<a href="{{ route('admin_banner_block', [$banner->id , '0'] ) }}" title="{{__('buttons.un_block')}}" onclick="return confirm('{{__("admin_banner.sure_un_block_banner")}}')"><i style="color:red" class="fa fa-ban" aria-hidden="true"></i></a>@endif | <a title="{{__('buttons.view')}}"  href="{{ route('admin_banner_view',$banner->id  ) }}" target="blank"><i class="fa fa-eye"></i></a>
                                    </td> 
                                </tr>
                                @endforeach
                                @endif  
                            </tbody>
                        </table>
                    </div>                     
                </div>
            </div>
            <div class="page_custom">{{ $banners->links() }}</div>
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

@endsection