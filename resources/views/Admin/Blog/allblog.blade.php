@extends('layouts.Admin.dashboard')
@section('title',__('admin_blog.all_blog'))
@section('content') 
  <link rel="stylesheet" href="{{ asset('admin/node_modules/lightgallery/dist/css/lightgallery.min.css') }}" />
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{__('admin_blog.all_blog')}}</h4>          
                    </div> 
                    <div class="col-6">
  <p class="page-description"><a style="float: right;" href="{{ route('admin_blog_add_get')}}" class="btn btn-primary">{{ __('admin_banner.create_n_banner') }}</a></p> 
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
                                    <th>{{__('admin_user.created_at')}}</th>  
                                    <th>{{__('buttons.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($blogs)>0) 
                                @foreach($blogs as $blog) 
                                <tr> 
                                    <td class="center">{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td> 
                                    <td><div id="lightgallery-without-thumb" class="lightGallery" style="max-width:50px !important;">
                                            <a href="{{asset('/uploads/admin_images/'.$blog->img)}}" class="image-tile">
                                                <img src="{{ asset('uploads/admin_images/'.$blog->img) }}" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="center">{{ date('d-M-Y', strtotime($blog->created_at)) }}</td>
                                    <td> <a title="{{__('buttons.edit')}}" href="{{ route('admin_blog_edit',$blog->id  ) }}" target="blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                        <a title="{{__('buttons.delete')}}" onclick="return confirm('{{__("admin_blog.sure_delete_blog")}}')" href="{{ route('admin_blog_delete', $blog->id ) }}" ><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a> | @if($blog->status=='active')<a href="{{ route('admin_blog_block', [$blog->id , '1'] ) }}" title="{{__('buttons.block')}}" onclick="return confirm('{{__("admin_blog.sure_block_blog")}}')"><i class="fa fa-ban" aria-hidden="true"></i></a>@else<a href="{{ route('admin_blog_block', [$blog->id , '0'] ) }}" title="{{__('buttons.un_block')}}" onclick="return confirm('{{__("admin_blog.sure_un_block_blog")}}')"><i style="color:red" class="fa fa-ban" aria-hidden="true"></i></a>@endif | <a title="{{__('buttons.view')}}"  href="{{ route('admin_blog_view',$blog->id  ) }}" target="blank"><i class="fa fa-eye"></i></a>
                                    </td> 
                                </tr>
                                @endforeach
                                @endif  
                            </tbody>
                        </table>
                    </div>                     
                </div>
            </div>
            <div class="page_custom">{{ $blogs->links() }}</div>
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