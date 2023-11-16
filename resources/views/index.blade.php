@extends('layouts.master')
@section('title','POS - Dashboard')
@section('livewire-style')
    @livewireStyles
@endsection
@section('livewire-script')
    @livewireScripts
@endsection
@section('content')
    @include('partials.sidebar')
    <div class="nk-wrap">
        @include('partials.header')
        <div class="nk-content ">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <p>{{date('Y-m-d')}}</p>
                                    <h3 class="nk-block-title page-title">{{__('welcome')}} {{auth()->user()->name}}</h3>
                                </div><!-- .nk-block-head-content -->
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            <ul class="nk-block-tools g-3">
                                                <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div><!-- .nk-block-between -->
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                                @include('dashboard_partials.main_buttons')
                                @livewire('dashboard-components.daily-information')
                                @include('dashboard_partials.sales_charts')
                                @include('dashboard_partials.yearly_report_chart')
                              <div class="row g-gs">
                                <div class="col-xxl-5">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group pb-3 g-2">
                                                <div class="card-title">
                                                    <h6 class="title">Income vs Expenses</h6>
                                                    <p>How was your income and Expenses this month.</p>
                                                </div>
                                                <div class="card-tools shrink-0 d-none d-sm-block">
                                                    <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                                        <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                                        <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                                        <li class="nav-item"><a href="#" class="nav-link">3 M</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="analytic-ov">
                                                <div class="analytic-data-group analytic-ov-group g-3">
                                                    <div class="analytic-data analytic-ov-data">
                                                        <div class="title text-primary">Income</div>
                                                        <div class="amount">2.57K</div>
                                                        <div class="change down"><em class="icon ni ni-arrow-long-down"></em>12.37%</div>
                                                    </div>
                                                    <div class="analytic-data analytic-ov-data">
                                                        <div class="title text-danger">Expenses</div>
                                                        <div class="amount">3.5K</div>
                                                        <div class="change down"><em class="icon ni ni-arrow-long-up"></em>8.37%</div>
                                                    </div>
                                                </div>
                                                <div class="analytic-ov-ck">
                                                    <canvas class="analytics-line-large" id="analyticOvData"></canvas>
                                                </div>
                                                <div class="chart-label-group ms-5">
                                                    <div class="chart-label">Jan</div>
                                                    <div class="chart-label">Feb</div>
                                                    <div class="chart-label">Mar</div>
                                                    <div class="chart-label">Apr</div>
                                                    <div class="chart-label">May</div>
                                                    <div class="chart-label">Jun</div>
                                                    <div class="chart-label">Jul</div>
                                                    <div class="chart-label">Aug</div>
                                                    <div class="chart-label">Oct</div>
                                                    <div class="chart-label">Nov</div>
                                                    <div class="chart-label">Dev</div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                </div><!-- .col -->
                                <div class="col-md-6 col-xxl-3" style="height: 100%">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Recent Transcation</h6>
                                                    </div>
                                                </div>
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sale</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Purchase</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Expenses</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        <table class="table table-bordered text-center mb-3" style="vertical-align: middle;">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('date')}}</th>
                                                                    <th>{{__('invoice #')}}</th>
                                                                    <th>{{__('customer name')}}</th>
                                                                    <th>{{__('total')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($recent_sales as $invoice)
                                                                <tr>
                                                                    <td style="direction: ltr;">{{$invoice->date}}</td>
                                                                    <td style="color: #465fff;"> {{$invoice->invoice_code}}</td>
                                                                    <td>
                                                                        @if ($invoice->customer_id == 0)
                                                                            {{__('walk in customer')}}
                                                                        @else
                                                                            {{$invoice->customer->name}}
                                                                        @endif
                                                                        </td>
                                                                    <td>{{$invoice->total}}</td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                      <table class="table table-bordered text-center mb-3" style="vertical-align: middle;">
                                                        <thead>
                                                            <tr>
                                                                <th>{{__('date')}}</th>
                                                                <th>{{__('invoice #')}}</th>
                                                                <th>{{__('supplier name')}}</th>
                                                                <th>{{__('total')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($recent_purchases as $invoice)
                                                            <tr>
                                                                <td style="direction: ltr;">{{$invoice->date}}</td>
                                                                <td style="color: #465fff;"> {{$invoice->invoice_code}}</td>
                                                                <td>{{$invoice->supplier->name}}</td>
                                                                <td>{{$invoice->total}}</td>
                                                            </tr>
                                                            @endforeach
                                                            
                                                            
                                                        </tbody>

                                                    </table>
                                                    </div>
                                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                        <table class="table table-bordered text-center mb-3" style="vertical-align: middle;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Category</th>
                                                                    <th>Expense For</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($recent_expenses as $expense)
                                                                <tr>
                                                                    <td>{{$expense->date}}</td>
                                                                    <td>{{$expense->category->name}}</td>
                                                                    <td>{{$expense->expense_for}}</td>
                                                                    <td>{{$expense->amount}}</td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                </div><!-- .col -->
                                <div class="col-md-6 col-xxl-4">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner border-bottom">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Recent Activities</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <ul class="card-tools-nav">
                                                        <li><a href="#"><span>Cancel</span></a></li>
                                                        <li class="active"><a href="#"><span>All</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nk-activity">
                                            <li class="nk-activity-item">
                                                <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                                                <div class="nk-activity-data">
                                                    <div class="label">Keith Jensen requested for room.</div>
                                                    <span class="time">2 hours ago</span>
                                                </div>
                                            </li>
                                            <li class="nk-activity-item">
                                                <div class="nk-activity-media user-avatar bg-warning">HS</div>
                                                <div class="nk-activity-data">
                                                    <div class="label">Harry Simpson placed a Order.</div>
                                                    <span class="time">2 hours ago</span>
                                                </div>
                                            </li>
                                            <li class="nk-activity-item">
                                                <div class="nk-activity-media user-avatar bg-azure">SM</div>
                                                <div class="nk-activity-data">
                                                    <div class="label">Stephanie Marshall cancelled booking.</div>
                                                    <span class="time">2 hours ago</span>
                                                </div>
                                            </li>
                                            <li class="nk-activity-item">
                                                <div class="nk-activity-media user-avatar bg-purple"><img src="./images/avatar/d-sm.jpg" alt=""></div>
                                                <div class="nk-activity-data">
                                                    <div class="label">Nicholas Carr confirmed booking.</div>
                                                    <span class="time">2 hours ago</span>
                                                </div>
                                            </li>
                                            <li class="nk-activity-item">
                                                <div class="nk-activity-media user-avatar bg-pink">TM</div>
                                                <div class="nk-activity-data">
                                                    <div class="label">Timothy Moreno placed a Order.</div>
                                                    <span class="time">2 hours ago</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!-- .card -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-files')
    <script>
    var barChartMultiple = {
    labels: ['Jun' , 'Feb' , 'Mar' , 'Apr' , 'May' , 'Jun' , 'Jul' , 'Aug' , 'Sep' , 'Oct' , 'Nov' , 'Dec'],
    dataUnit: 'EGP',
    datasets: [{
      label: "Sales",
      color: "#9cabff",
      data: JSON.parse('{!! json_encode($total_sales_monthes) !!}')
    },
    {
      label: "Purchase",
      color: "#1ee0ac",
      data: JSON.parse('{!! json_encode($total_sales_monthes) !!}')
    }, {
      label: "Expense",
      color: "#f4aaa4",
      data: JSON.parse('{!! json_encode($total_expenses_monthes) !!}')
    }]
  };
  function barChart(selector, set_data) {
    var $selector = selector ? $(selector) : $('.bar-chart');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          data: _get_data.datasets[i].data,
          // Styles
          backgroundColor: _get_data.datasets[i].color,
          borderWidth: 2,
          borderColor: 'transparent',
          hoverBorderColor: 'transparent',
          borderSkipped: 'bottom',
          barPercentage: .6,
          categoryPercentage: .7
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'bar',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : true,
            rtl: NioApp.State.isRTL,
            labels: {
              boxWidth: 30,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return data.datasets[tooltipItem[0].datasetIndex].label;
              },
              label: function label(tooltipItem, data) {
                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
              }
            },
            backgroundColor: '#eff6ff',
            titleFontSize: 13,
            titleFontColor: '#6783b8',
            titleMarginBottom: 6,
            bodyFontColor: '#9eaecf',
            bodyFontSize: 12,
            bodySpacing: 4,
            yPadding: 10,
            xPadding: 10,
            footerMarginTop: 0,
            displayColors: false
          },
          scales: {
            yAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              position: NioApp.State.isRTL ? "right" : "left",
              ticks: {
                beginAtZero: true,
                fontSize: 12,
                fontColor: '#9eaecf',
                padding: 5
              },
              gridLines: {
                color: NioApp.hexRGB("#526484", .2),
                tickMarkLength: 0,
                zeroLineColor: NioApp.hexRGB("#526484", .2)
              }
            }],
            xAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                fontSize: 12,
                fontColor: '#9eaecf',
                source: 'auto',
                padding: 5,
                reverse: NioApp.State.isRTL
              },
              gridLines: {
                color: "transparent",
                tickMarkLength: 10,
                zeroLineColor: 'transparent'
              }
            }]
          }
        }
      });
    });
  }
  // init bar chart
  barChart();
    </script>
    <script>
         // init chart
    NioApp.coms.docReady.push(function () {
    analyticsDoughnut();
  });
  var MonthlyInfo = {
    labels: ["Sales", "Purchase","Expense" ],
    dataUnit: "EGP",
    legend: true,
    datasets: [{
      borderColor: "#fff",
      background: ["#798bff", "#1ee0ac", "#f9db7b"],
      data: [{{$monthly_sales}}, 859, {{$monthly_expenses}}]
    }]
  };
  function analyticsDoughnut(selector, set_data) {
    var $selector = selector ? $(selector) : $('.analytics-doughnut');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          backgroundColor: _get_data.datasets[i].background,
          borderWidth: 2,
          borderColor: _get_data.datasets[i].borderColor,
          hoverBorderColor: _get_data.datasets[i].borderColor,
          data: _get_data.datasets[i].data
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'doughnut',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            labels: {
              boxWidth: 12,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          rotation: -1.5,
          cutoutPercentage: 70,
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
              },
              label: function label(tooltipItem, data) {
                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
              }
            },
            backgroundColor: '#fff',
            borderColor: '#eff6ff',
            borderWidth: 2,
            titleFontSize: 13,
            titleFontColor: '#6783b8',
            titleMarginBottom: 6,
            bodyFontColor: '#9eaecf',
            bodyFontSize: 12,
            bodySpacing: 4,
            yPadding: 10,
            xPadding: 10,
            footerMarginTop: 0,
            displayColors: false
          }
        }
      });
    });
  }
    </script>
    <script>
        var filledLineChart = {
    labels:  ['Jun' , 'Feb' , 'Mar' , 'Apr' , 'May' , 'Jun' , 'Jul' , 'Aug' , 'Sep' , 'Oct' , 'Nov' , 'Dec'],
    dataUnit: 'EGP',
    lineTension: .4,
    datasets: [{
      label: "Total Received",
      color: "#798bff",
      background: NioApp.hexRGB('#798bff', .4),
      data: JSON.parse('{!! json_encode($total_sales_monthes) !!}')
    }]
  };
  function lineChart(selector, set_data) {
    var $selector = selector ? $(selector) : $('.line-chart');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          tension: _get_data.lineTension,
          backgroundColor: _get_data.datasets[i].background,
          borderWidth: 2,
          borderColor: _get_data.datasets[i].color,
          pointBorderColor: _get_data.datasets[i].color,
          pointBackgroundColor: '#fff',
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: _get_data.datasets[i].color,
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 2,
          pointRadius: 4,
          pointHitRadius: 4,
          data: _get_data.datasets[i].data
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'line',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            rtl: NioApp.State.isRTL,
            labels: {
              boxWidth: 12,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
              },
              label: function label(tooltipItem, data) {
                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
              }
            },
            backgroundColor: '#eff6ff',
            titleFontSize: 13,
            titleFontColor: '#6783b8',
            titleMarginBottom: 6,
            bodyFontColor: '#9eaecf',
            bodyFontSize: 12,
            bodySpacing: 4,
            yPadding: 10,
            xPadding: 10,
            footerMarginTop: 0,
            displayColors: false
          },
          scales: {
            yAxes: [{
              display: true,
              position: NioApp.State.isRTL ? "right" : "left",
              ticks: {
                beginAtZero: false,
                fontSize: 12,
                fontColor: '#9eaecf',
                padding: 10
              },
              gridLines: {
                color: NioApp.hexRGB("#526484", .2),
                tickMarkLength: 0,
                zeroLineColor: NioApp.hexRGB("#526484", .2)
              }
            }],
            xAxes: [{
              display: true,
              ticks: {
                fontSize: 12,
                fontColor: '#9eaecf',
                source: 'auto',
                padding: 5,
                reverse: NioApp.State.isRTL
              },
              gridLines: {
                color: "transparent",
                tickMarkLength: 10,
                zeroLineColor: NioApp.hexRGB("#526484", .2),
                offsetGridLines: true
              }
            }]
          }
        }
      });
    });
  }

  // init line chart
  lineChart();

    </script>
@endsection