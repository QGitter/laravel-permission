@include('common/header')
<body>
@include('common/top')

<div class="container-fluid content">

    <div class="row">

        @include('common/menu')

        <!-- start: Content -->
        <div class="main">

            <div class="row">
                <div class="col-lg-12">
                   {{-- <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>--}}
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Dashboard</li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box red-bg">
                        <i class="fa fa-thumbs-o-up"></i>
                        <div class="count">356K</div>
                        <div class="title">Order</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box green-bg">
                        <i class="fa fa-cubes"></i>
                        <div class="count">425K</div>
                        <div class="title">Stock</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box blue-bg">
                        <i class="fa fa-cloud-download"></i>
                        <div class="count">325K</div>
                        <div class="title">Download</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box magenta-bg">
                        <i class="fa fa-shopping-cart"></i>
                        <div class="count">259K</div>
                        <div class="title">Purchased</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->

            </div><!--/.row-->

            <div class="row">

                <div class="col-lg-9 col-md-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <i class="fa fa-refresh red"></i><h2><strong>Real-time updates</strong></h2>

                            <div class="panel-actions">
                                <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            </br/>
                            <div id="realtime-update" style="height:200px;color:#484848;"></div>
                        </div>
                    </div>
                </div><!--/col-->
                <div class="col-lg-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body white-bg">
                            </br/>
                            <div class="graph-container text-center">
                                <div id="hero-donut" class="graph" style="height:236px;"></div>
                            </div>
                        </div>
                    </div>
                </div><!--/.col-->

            </div><!--/.row-->

            <div class="row">

                <div class="col-lg-6 col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-map-marker red"></i><strong>Countries</strong></h2>
                            <div class="panel-actions">
                                <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="map" style="height:286px;"></div>
                        </div>

                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Registered Users</strong></h2>
                            <div class="panel-actions">
                                <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Country</th>
                                    <th>Users</th>
                                    <th>Online</th>
                                    <th>Performance</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="{{ asset('assets/ico/flags/Germany.png') }}" style="height:18px; margin-top:-2px;"></td>
                                    <td>Germany</td>
                                    <td>2563</td>
                                    <td>1025</td>
                                    <td>
                                        <div class="progress thin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
                                            </div>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%">
                                            </div>
                                        </div>
                                        <span class="sr-only">73%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('assets/ico/flags/India.png') }}" style="height:18px; margin-top:-2px;"></td>
                                    <td>India</td>
                                    <td>3652</td>
                                    <td>2563</td>
                                    <td>
                                        <div class="progress thin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                            </div>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%">
                                            </div>
                                        </div>
                                        <span class="sr-only">57%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('assets/ico/flags/Spain.png') }}" style="height:18px; margin-top:-2px;"></td>
                                    <td>Spain</td>
                                    <td>562</td>
                                    <td>452</td>
                                    <td>
                                        <div class="progress thin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%">
                                            </div>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100" style="width: 7%">
                                            </div>
                                        </div>
                                        <span class="sr-only">93%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('assets/ico/flags/Russia.png') }}" style="height:18px; margin-top:-2px;"></td>
                                    <td>Russia</td>
                                    <td>1258</td>
                                    <td>958</td>
                                    <td>
                                        <div class="progress thin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            </div>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            </div>
                                        </div>
                                        <span class="sr-only">20%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('assets/ico/flags/usa.png') }}" style="height:18px; margin-top:-2px;"></td>
                                    <td>USA</td>
                                    <td>4856</td>
                                    <td>3621</td>
                                    <td>
                                        <div class="progress thin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            </div>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            </div>
                                        </div>
                                        <span class="sr-only">20%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('assets/ico/flags/brazil.png') }}" style="height:18px; margin-top:-2px;"></td>
                                    <td>Brazil</td>
                                    <td>265</td>
                                    <td>102</td>
                                    <td>
                                        <div class="progress thin">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            </div>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            </div>
                                        </div>
                                        <span class="sr-only">20%</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div><!--/col-->


                <div class="col-lg-3 col-md-12">

                    <div class="panel panel-default">

                        <div class="panel-body weather widget">

                            <div class="today text-center">

                                <h4 class="blue"><strong><i class="fa fa-map-marker fa-3x red"></i> Nevada</strong></h4>
                                <i class="climacon snow moon"></i>


                                <div class="row">

                                    <div class="col-xs-5 text-right date">
                                        <div>Thursday</div>
                                        <small>July, 10</small>
                                    </div><!--/.col-->

                                    <div class="col-xs-7 text-left temp">
                                        15°C
                                    </div><!--/.col-->

                                </div><!--/.row-->

                            </div>

                            <div class="forecast row text-center">

                                <div class="col-xs-4">
                                    <i class="climacon lightning sun"></i>
                                    <span class="label label-primary">MON</span>
                                    <p>40°C</p>
                                </div><!--/.col-->

                                <div class="col-xs-4">
                                    <i class="climacon snow moon"></i>
                                    <span class="label label-primary">TUE</span>
                                    <p>18°C</p>
                                </div><!--/.col-->

                                <div class="col-xs-4">
                                    <i class="climacon hail sun"></i>
                                    <span class="label label-primary">WED</span>
                                    <p>25°C</p>
                                </div><!--/.col-->

                            </div>

                        </div>
                    </div>

                </div><!--/.col-->

                <div class="col-lg-3 col-md-12">

                    <div class="panel panel-default">

                        <div class="panel-body weather widget">

                            <div class="today text-center">

                                <h4 class="blue"><strong><i class="fa fa-map-marker fa-3x red"></i> California</strong></h4>
                                <i class="climacon rain"></i>


                                <div class="row">

                                    <div class="col-xs-5 text-right date">
                                        <div>Thursday</div>
                                        <small>July, 10</small>
                                    </div><!--/.col-->

                                    <div class="col-xs-7 text-left temp">
                                        18°C
                                    </div><!--/.col-->

                                </div><!--/.row-->

                            </div>

                            <div class="forecast row text-center">

                                <div class="col-xs-4">
                                    <i class="climacon lightning sun"></i>
                                    <span class="label label-primary">MON</span>
                                    <p>35°C</p>
                                </div><!--/.col-->

                                <div class="col-xs-4">
                                    <i class="climacon fog sun"></i>
                                    <span class="label label-primary">TUE</span>
                                    <p>28°C</p>
                                </div><!--/.col-->

                                <div class="col-xs-4">
                                    <i class="climacon rain"></i>
                                    <span class="label label-primary">WED</span>
                                    <p>17°C</p>
                                </div><!--/.col-->

                            </div>

                        </div>
                    </div>

                </div><!--/.col-->

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-default">

                        <div class="panel-body text-center" style="height:230px">
                            <h2 class="lime">Sold Out</h2>
                            <div style="width:300px;left:50%;position:absolute;margin-left:-150px;">
                                <canvas id="gauge1"></canvas>
                            </div>
                            <span class="pull-left"><strong class="blue">$256.256,25</strong></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-o-up text-success"></i> 52%</span>
                        </div>

                    </div>

                </div><!--/.col-->

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-default">

                        <div class="panel-body text-center" style="height:230px">
                            <h2 class="lime">Profit</h2>
                            <div style="width:300px;left:50%;position:absolute;margin-left:-150px;">
                                <canvas id="gauge2"></canvas>
                            </div>
                            <span class="pull-left"><strong class="blue">$125.365,56</strong></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-o-up text-success"></i> 70%</span>
                        </div>

                    </div>

                </div><!--/.col-->
            </div><!--/row-->

            <div class="row">

                <div class="col-sm-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-bar-chart-o red"></i><strong>xCharts</strong></h2>
                            <div class="panel-actions">
                                <a href="charts-xcharts.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="charts-xcharts.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="charts-xcharts.html#" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <figure class="demo" id="chart" style="height: 300px"></figure>
                        </div>
                    </div>

                </div><!--/col-->

            </div><!--/row-->



        <!-- end: Content -->
        <br><br><br>




    </div><!--/container-->




    <div class="clearfix"></div>

</div>
@include('common/footer')