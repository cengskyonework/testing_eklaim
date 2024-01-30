@extends('layouts.app')

@section('content')
    <?php
    // namespace App\Http\Controllers;
    
    // use Illuminate\Http\Request;
    // use App\Property;
    // use Auth;
    // use DB;
    
    function total_queries($y)
    {
        // $datess = $d;
        $dates = $y . '-01-01';
        if (Auth::user()->user_type == 'user') {
            $idx = Auth::user()->distri_id;
            $search_query1 = '[';
            $search_queries1 = \DB::select("SELECT m.month, COUNT(id) as total_queries
        			FROM ( SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH 
        			UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH 
        			UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH 
        			UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH ) AS m
        			LEFT JOIN claim ON distributor_id = '$idx' AND m.month = MONTH(created_at) AND YEAR(created_at) = YEAR('$dates') 
        			GROUP BY m.month ORDER BY m.month ASC");
            foreach ($search_queries1 as $row) {
                $search_query1 .= $row->total_queries . ',';
            }
            return $search_query1 . ']';
        } else {
            $search_query2 = '[';
            $search_queries2 = \DB::select("SELECT m.month, COUNT(id) as total_queries
        			FROM ( SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH 
        			UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH 
        			UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH 
        			UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH ) AS m 
        			LEFT JOIN claim ON m.month = MONTH(created_at) AND YEAR(created_at) = YEAR('$dates') 
        			GROUP BY m.month ORDER BY m.month ASC");
            foreach ($search_queries2 as $row) {
                $search_query2 .= $row->total_queries . ',';
            }
            return $search_query2 . ']';
        }
    }
    
    function total_category($y)
    {
        // $datedd = $dt;
        $date = $y;
    
        if (Auth::user()->user_type == 'user') {
            $idx = Auth::user()->distri_id;
            $total_category = '[';
            $totals = \DB::select("SELECT  count(id) as total_category, status from claim  where distributor_id = '$idx' and year(created_at)='$date' GROUP by  status");
            foreach ($totals as $row) {
                $total_category .= "[ '" . klaimi_status($row->status) . "'," . $row->total_category . '],';
            }
            return $total_category . ']';
        } else {
            $total_category = '[';
            $totals = \DB::select("SELECT  count(id) as total_category, status from claim  where year(created_at)='$date' GROUP by  status");
            foreach ($totals as $row) {
                $total_category .= "[ '" . klaimi_status($row->status) . "'," . $row->total_category . '],';
            }
            return $total_category . ']';
        }
    }
    ?>



    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">{{ _lang('Total Claim') }}</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $total_property }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->user_type != 'user')
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-receipt text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">{{ _lang('Total Distributor') }}</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ $featured_property }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">{{ _lang('Claim Belum Dibayarkan') }}</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $sold_property }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->user_type != 'user')
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-account-location text-info icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">{{ _lang('Total Users') }}</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ $inactive_property }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>



	<div class="form-group row">
		
		<label for="periode" class="col-sm-3 col-form-label" style="font-size: 17px">Pilih periode untuk di tampilkan di dalam chart</label>
		<div class="col-sm-9">
			<select class="form-control" onchange="updateCharts()" id="periode" style="font-size: 17px">
				<option value="2024" style="font-size: 17px">2024</option>
				<option value="2023" style="font-size: 17px">2023</option>
			</select>
		</div>
	  </div>


    <br>
    <div class="row">
        <div class="col-lg-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div id="total_category" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
    </div>

@endsection
@section('js-script')
    <script>
        var chart1, chart2, selectedPeriode;

        function updateCharts() {
            selectedPeriode = document.getElementById('periode').value;
            if (selectedPeriode == "2023") {
                chart1.series[0].setData(<?php echo total_queries('2023'); ?>);
                chart2.series[0].setData(<?php echo total_category('2023'); ?>);
            } else if (selectedPeriode == "2024") {
                chart1.series[0].setData(<?php echo total_queries('2024'); ?>);
                chart2.series[0].setData(<?php echo total_category('2024'); ?>);
            }

            // location.reload();
        }

        document.addEventListener('DOMContentLoaded', function() {
            chart1 = Highcharts.chart('container', {
                // ... (Konfigurasi grafik garis yang sudah ada)
                chart: {
                    type: 'line'
                },
                title: {
                    text: '{{ _lang('Total Claim') }}'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ]
                },
                yAxis: {
                    title: {
                        text: '{{ _lang('Claim') }}'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: 'Total Claim',
                    color: '#FFD700',
                    data: <?php echo total_queries('2024'); ?>
                }]
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            chart2 = Highcharts.chart('total_category', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: '{{ _lang('Status Klaim') }} '
                },
                yAxis: {
                    title: {
                        text: '{{ _lang('In This Years') }}'
                    }
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: 'Klaim',
                    data: <?php echo total_category('2024'); ?>
                }]
            });
        });
    </script>
@stop
