@extends('Admin.layout')

@section('title')
     Dashboard
@stop

@section('content')

        <link href="/admin/css/mystyle.min.css" rel="stylesheet">
        <script src="/admin/js/plugins/highchats/highcharts.js"></script>
        <script src="/admin/js/plugins/highchats/exporting.js"></script>
        <script src="/admin/js/plugins/fullcalendar/moment.min.js"></script>

        <link href="/admin/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
        <script src="/admin/js/plugins/daterangepicker/daterangepicker.js"></script>
        <link href="/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
        <script src="/admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>

            <div class="wrapper wrapper-content animated" data-animation="rotateInUpLeft">

    	<!-- <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>
                            Dashboard
                        </h2>
                        <ol class="breadcrumb">
                            <li>
                                <a class="active" href="{{route('admin_dashboard')}}">
                                    <strong>
                                        Dashboard
                                    </strong>                            
                                </a>
                            </li>
                        </ol>
                    </div>
                </div> -->
            <br>
            <div class="row">
                    <div class="col-md-offset-1 col-lg-10 col-lg-offset-1  col-md-10 col-sm-offset-1  col-sm-10">
                        <center>
                            <label>
                                Filter Data
                            </label>
                        </center>

                            <center>
                                <input date-range-picker id="daterange" name="daterange" class="form-control date-picker active" type="text" clearable="true" options="dateRangeOptions" value="{{$starting_dt}} - {{$ending_dt}}"/>
                            </center>

                           <br>

                    </div>

            </div>



                    <div class="row">

                        <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" onclick="javascript:location.href=''">
                            <div class="small-box bg-light-blue">
                                <div class="inner">
                                    <h3 id="users_count" class="users_count">
                                        &nbsp;
                                    </h3>
                                    <p>
                                      Users
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" onclick="javascript:location.href=''">
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3 id="products_count" class="products_count">
                                        &nbsp;
                                    </h3>
                                    <p>
                                      Products
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-product-hunt"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" onclick="javascript:location.href=''">
                            <div class="small-box bg-olive">
                                <div class="inner">
                                    <h3 id="sales_count" class="sales_count">
                                        &nbsp;
                                    </h3>
                                    <p>
                                      Sales
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4" onclick="javascript:location.href=''">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3 id="conflicts_count" class="conflicts_count">
                                        &nbsp;
                                    </h3>
                                    <p>
                                      Conflicts
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bullhorn"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                  </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="form-group" id="data_1">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" value="<?php echo date("Y"); ?>" id="starting_date" name="starting_date">
                                </div><br>
                                <center>
                                    <button class="button btn btn-primary btn-lg" onclick="new_get_dashboard_data()">
                                        Get Monthly Details
                                    </button>
                                </center>
                            </div>
                            <div id="container1" style="min-width: 100%; height: 100%; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    <script>


$("#dashboard").addClass("active");

    new_get_dashboard_data();


        $("#starting_date").datepicker( {
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
                });


    $(document).ready(function()
            {

                setInterval(function()
                    {
                        new_get_dashboard_data();
                    }, 60000);

            });

        function new_get_dashboard_data()
            {

                dt = document.getElementById('daterange').value;
                yr = document.getElementById('starting_date').value;
                dt = encodeURIComponent(dt);
                route = '{!! route('get_dashboard_data') !!}?daterange='+dt+'&yr_only='+yr;
                $.ajax({
                    url: route,
                    type: 'GET',
                    async: true,
                    dataType: "json",
                    success: function (data)
                            {
                                if(data.success == '0')
                                    {
                                        toastr.error(data.msg, 'Error')
                                    }
                                else
                                    {
                                        assign_dashboard_data(data.stats);
                                        graph_data(data);
                                    }
                            }
                        });

            }

        function assign_dashboard_data(stats)
            {
                document.getElementById('users_count').innerHTML = stats.users_count;
                document.getElementById('products_count').innerHTML = stats.products_count;
                document.getElementById('sales_count').innerHTML = stats.sales_count;
                document.getElementById('conflicts_count').innerHTML = stats.conflicts_count;
            }


    function graph_data(data)
        {
            //console.log(data.graph_data.users, data);
            document.getElementById('starting_date').value = data.graph_data.dt;

            $('#container1').highcharts({
                title: {
                    text: 'Monthly Details Chart',
                    x: -20
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    allowDecimals:false,
                    title: {
                        text: 'Count'
                    },
                    plotLines: [{
                        value: 0.2,
                        width: 1.2,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ''
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [
                    {
                        name: 'Users',
                        data:   data.graph_data.users,
                        color: '#00AEEC'
                    },
                    {
                        name: 'Products',
                        data: data.graph_data.products,
                        color: '#86164B'
                    },
                    {
                        name: 'Sales',
                        data: data.graph_data.sales,
                        color: '#358966'
                    },
                    {
                        name: 'Conflicts',
                        data: data.graph_data.conflicts,
                        color: '#F96656'
                    }
                        ]
            });

        }


            $('input[name="daterange"]').daterangepicker({
                format: 'DD/MM/YYYY',
                opens: 'center',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default'
                    });

            $('#daterange').on('apply.daterangepicker', function(ev, picker)
                {
                  var startDate = picker.startDate.format('DD/MM/YYYY');
                  var endDate = picker.endDate.format('DD/MM/YYYY');

                    new_get_dashboard_data();
                });


    </script>

@stop
