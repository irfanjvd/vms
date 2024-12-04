            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">
            
                     

                <div class="page page-dashboard">

                    <div class="pageheader">

                        

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="javascript:void(0)"><i class="fa fa-home"></i> VMS</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a>
                                </li>
                            </ul>

                          <div id="critical_rows" class="" style="float:right;background-color:red;color:white;padding:5px;border-radius:3px;height:30px;cursor:default">          
                            <p id="critical_msg"></p>
                          </div>

                        </div>
                        
<!--                        <h2>Visiting Listings <span>VMS - Visitors Management System</span></h2>-->

                    </div>
                    <input type="hidden" id="type" value="<?php echo $type; ?>">
                    

                    <!-- cards row -->
                    <div class="row">

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-greensea">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <!--<div class="col-xs-4">
                                            <i class="fa fa-eye fa-4x"></i>
                                        </div>-->
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-12 listing" >
                                            <p class="text-elg text-strong mb-0">
                                                <?php echo number_format($today_total, 0, ' ', ' '); ?>        
                                            </p>
                                            <span>Today's Visits</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-greensea">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="<?php echo base_url().'visitor/index/today'; ?>"><i class="fa fa-list fa-2x"></i> Visit Today's Listings</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                            
                            <div class="col-xs-12  bg-greensea"  style="padding:6px; margin-bottom:20px; text-align:center;">
                            	<div class="col-xs-6">
                                	<p class="btn_value"><?php echo $today_checkin; ?></p>
                                    <P class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</P>
                                	<!-- <button type="submit" class="btn btn-default complete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</button> -->
                                </div>
                                <div class="col-xs-6">
                                	<p class="btn_value"><?php echo $today_checkout; ?></p>
                                    <P class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</P>
                                	<!-- <button type="submit" class="btn btn-default incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</button> -->
                                </div>
                            </div>
                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-lightred">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <!--<div class="col-xs-4">
                                            <i class="fa fa-tripadvisor fa-4x"></i>
                                        </div>-->
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-12 listing">
                                            <p class="text-elg text-strong mb-0">
                                                <?php echo number_format($week_total, 0, ' ', ' ');; ?>
                                            </p>
                                            <span>Weekly Visits</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-lightred">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="<?php echo base_url().'visitor/index/weekly'; ?>"><i class="fa fa-list fa-2x"></i> Visit Weekly Listings</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                            
                            <div class="col-xs-12  bg-lightred"  style="padding:6px; margin-bottom:20px; text-align:center;">
                            	<div class="col-xs-6">
                                	<p class="btn_value"><?php echo $week_checkin; ?></p>
                                    <p class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</p>
                                	<!-- <button type="button" class="btn btn-default complete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</button> -->
                                </div>
                                <div class="col-xs-6">
                                	<p class="btn_value"><?php echo $week_checkout; ?></p>
                                    <p class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</p>
                                	<!-- <button type="button" class="btn btn-default incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</button> -->
                                </div>
                            </div>
                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-blue">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <!--<div class="col-xs-4">
                                            <i class="fa fa-binoculars fa-4x"></i>
                                        </div>-->
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-12 listing">
                                            <p class="text-elg text-strong mb-0">
                                                <?php echo number_format($month_total, 0, ' ', ' '); ?>
                                            </p>
                                            <span>Monthly Visits</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-blue">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="<?php echo base_url().'visitor/index/monthly'; ?>"><i class="fa fa-list fa-2x"></i>View Monthly Listings</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                
                                
                            </div>
                            
                            <div class="col-xs-12  bg-blue"  style="padding:6px; margin-bottom:20px; text-align:center;">
                            	<div class="col-xs-6">
                                	<p class="btn_value"><?php echo $month_checkin; ?></p>
                                    <P class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</P>
                                	<!-- <button type="submit" class="btn btn-default complete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</button> -->
                                </div>
                                <div class="col-xs-6">
                                	<p class="btn_value"><?php echo $month_checkout; ?></p>
                                    <p class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</p>
                                	<!-- <button type="submit" class="btn btn-default incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</button> -->
                                </div>
                            </div>

                            
                            
                            
                            
                            
                            
                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">

                            <div class="card">
                                <div class="front bg-slategray">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <!--<div class="col-xs-4">
                                            <i class="fa fa-eye fa-4x"></i>
                                        </div>-->
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-12 listing">
                                            <p class="text-elg text-strong mb-0">
                                                <?php echo number_format($total_total, 0, ' ', ' '); ?>
                                            </p>
                                            <span>Total Visits</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-slategray">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="<?php echo base_url().'visitor/index/all'; ?>"><i class="fa fa-list fa-2x"></i> View Total Listings</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                            
                            <div class="col-xs-12  bg-slategray"  style="padding:6px; margin-bottom:20px; text-align:center;">
                            	<div class="col-xs-6">
                                	<p class="btn_value"><?php echo $total_checkin; ?></p>
                                    <p class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</p>
                                	<!-- <button type="submit" class="btn btn-default complete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked In</button> -->
                                </div>
                                <div class="col-xs-6">
                                	<p class="btn_value"><?php echo $total_checkout; ?></p>
                                    <p class="incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</p>
                                	<!-- <button type="submit" class="btn btn-default incomplete-button" style="margin-top:0px !important;margin-left:0px !important;">Checked Out</button> -->
                                </div>
                            </div>
                        </div>
                        <!-- /col -->

                    </div>
                    <!-- /row -->


                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <select class="form-control" onchange="load_graph(value)">
                                        <option value="weekly">Current Week</option>
                                        <option value="monthly">Current Month</option>
                                        <option value="-15">Last 15 Days</option>
                                        <option value="-30">Last 30 Days</option>

                                    </select>    
                                </div>
                            </div>
                            
                            <figure class="highcharts-figure">
                                    <div id="visits_chart"></div>
                                    
                            </figure>
                            <br>
                            <!-- tile -->
                            <section class="tile">
                                <figure class="highcharts-figure">
                                    <div id="visits_chart_pie"></div>    
                                </figure>
                                <br>
                                <!-- tile header -->

                                <!-- <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong><?php echo ucfirst($type); ?> Visits </strong>Listing</h1> (<?php echo date("Y-m-d"); ?>)

                                </div> -->
                                <!-- /tile header -->

                                <!-- tile body -->
                                <!--<div class="tile-body table-custom">
                                    <div class="table-responsive">
                                        <table id="list_visits_dashboard" class="table table-bordered table-striped visit_listing_dashboard">
                                            <thead class="custom-font">
                                            <tr role="row">
                                                <th class="sorting" role="columnheader">Visitor Name</th>
                                                <th class="sorting" role="columnheader">Visitor Address</th>
                                                <th class="sorting" role="columnheader">Visitor Cell</th>
                                                <th class="sorting" role="columnheader">Identity Type</th>
                                                <th class="sorting" role="columnheader">Identity No</th>
                                                <th class="sorting" role="columnheader">Visit Reason</th>
                                                <th class="sorting" role="columnheader">Company</th>
                                                <th class="sorting" role="columnheader">Transport</th>
                                                <th class="sorting" role="columnheader">Registration Number</th>
                                                <th class="sorting" role="columnheader">Issued Card</th>
                                                <th class="sorting" role="columnheader">Check In</th>
                                                <th class="sorting" role="columnheader">Check Out</th>
                                                <th class="sorting" role="columnheader">Visit Date</th>
                                                <th class="sorting" role="columnheader">Location</th>
                                            </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all">


                                            </tbody>

                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>-->
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->

                    </div>

                    
                </div>
                
                

                
            </section>
            <!--/ CONTENT -->
<script>
// Create the chart
var chart='';
$( document ).ready(function() {
    setTimeout(function() {
        $.ajax({
            method: "GET",
            url: "<?php echo base_url();?>visit/get_critical_visits",
            success: function(data) {
                $("#critical_rows").show();
                $("#critical_msg").html("<div>Critical visits in last 7 days are <b>" + data + "</b></div>");
                $("#critical_msg1").html("<div> <b>" + data + "</b></div>");
                
            },async: false
            
            
        });            
    },20);
    chart=Highcharts.chart('visits_chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Visits Graph'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Visits'
            },
            stackLabels: {
                enabled: true,
                 formatter: function () {
                        return Highcharts.numberFormat(this.total, 0, '.', ',');
                    },
            }
        },
        plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (data) {
                             var param = { 'date' : data.point.name};
                             OpenWindowWithPost("<?php echo base_url().'visit/visits/' ?>",'abc','_blank',param);
                        }
                    }
                },
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.0f}'
                },
                pointWidth: 25,
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
        },

        series: [
            {
                name: "Visits",
                colorByPoint: true,
                data:<?php echo json_encode($week_result,JSON_NUMERIC_CHECK ); ?>,
                
            }
        ],
        
    });

    chart=Highcharts.chart('visits_chart_pie', {
        chart: {
             plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Today Tenant Visits Graph'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Visits'
            },
            stackLabels: {
                enabled: true,
                 formatter: function () {
                        return Highcharts.numberFormat(this.total, 0, '.', ',');
                    },
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.0f} '
                }
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
        },

        series: [
            {
                name: "Visits",
                colorByPoint: true,
                data:<?php echo json_encode($tenant_graph_result,JSON_NUMERIC_CHECK ); ?>,
                
            }
        ],
        
    });


});


    function OpenWindowWithPost(url, windowoption, name, params){
        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", url);
            form.setAttribute("target", name);

            for (var i in params) {
                if (params.hasOwnProperty(i)) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = i;
                    input.value = params[i];
                    //input.csrf_test_name=csrf_value;
                    form.appendChild(input);
                    var input2 = document.createElement('input');
                    input2.type = 'hidden';
                    input2.name = 'csrf_test_name';
                    input2.value = csrf_value;
                    form.appendChild(input2);
                }
            }
            
            document.body.appendChild(form);
            
            //note I am using a post.htm page since I did not want to make double request to the page 
           //it might have some Page_Load call which might screw things up.
            //window.open("post.htm", name, windowoption);
            
            form.submit();
            
            document.body.removeChild(form);
    }

function load_graph(date){
    var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>visit/get_graph_visits",
        data: "date="+date+"&csrf_test_name="+ csrf_value,
        success: function(graph_data) {
            graph_data=JSON.parse(graph_data);
            /*chart=Highcharts.chart('visits_chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total Visits Graph'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Visits'
                    },
                    stackLabels: {
                        enabled: true,
                         formatter: function () {
                                return Highcharts.numberFormat(this.total, 0, '.', ',');
                            },
                    }
                },
                plotOptions: {
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function (data) {
                                     var param = { 'date' : data.point.name};
                             OpenWindowWithPost("<?php echo base_url().'visit/visits/' ?>",'abc','',param),"_blank";
                                }
                            }
                        },
                        borderWidth: 0,
                        dataLabels: {
                            //enabled: true,
                            format: '{point.y:.1f}'
                        },
                        pointWidth: 15,
                    }

                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [
                    {
                        name: "Visits",
                        colorByPoint: true,
                        data:graph_data,
                        
                    }
                ],
                
            });*/
            chart=Highcharts.chart('visits_chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total Visits Graph'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Visits'
                    },
                    stackLabels: {
                        enabled: true,
                         formatter: function () {
                                return Highcharts.numberFormat(this.total, 0, '.', ',');
                            },
                    }
                },
                plotOptions: {
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function (data) {
                                     var param = { 'date' : data.point.name};
                                     OpenWindowWithPost("<?php echo base_url().'visit/visits/' ?>",'abc','_blank',param);
                                }
                            }
                        },
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        },
                        pointWidth: 25,
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [
                    {
                        name: "Visits",
                        colorByPoint: true,
                        data:graph_data,
                        
                    }
                ],
                
            });
        },
        async: false

    });
}
</script>