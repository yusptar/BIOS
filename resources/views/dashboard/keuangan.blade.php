@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Dashboard Keuangan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><strong>Realisasi Pendapatan dan Belanja</strong></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  <strong>Jumlah Saldo Kas</strong>
                </h3>

                <div class="card-tools">
                  Real time
                  <div class="btn-group" id="realtimeKAS" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="saldoKas" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title"><strong>Analisis Data Keuangan</strong></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  <strong>Jumlah Saldo Rekening BLU</strong>
                </h3>

                <div class="card-tools">
                  Real time
                  <div class="btn-group" id="realtimeBLU" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="saldoBLU" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
@section('script')
<script>
  $(function () {
    // //---------------------
    // //- REALISASI PENDAPATAN -
    // //---------------------
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    var areaChartData = {
      labels  : <?php echo json_encode($months); ?>,
      datasets: [
        {
          label               : 'Pendapatan',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [10, 48, 40, 19, 86, 27, 90, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Pengeluaran',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40, 40, 19, 86, 27, 90]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    var areaChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    // //-------------
    // //- LINE CHART -
    // //--------------
    // var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    // var lineChartOptions = $.extend(true, {}, areaChartOptions)
    // var lineChartData = $.extend(true, {}, areaChartData)
    // lineChartData.datasets[0].fill = false;
    // lineChartData.datasets[1].fill = false;
    // lineChartOptions.datasetFill = false

    // var lineChart = new Chart(lineChartCanvas, {
    //   type: 'line',
    //   data: lineChartData,
    //   options: lineChartOptions
    // })

    // //-------------
    // //- DONUT CHART -
    // //-------------
    // // Get context with jQuery - using jQuery's .get() method.
    // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    // var donutData        = {
    //   labels: [
    //       'Chrome',
    //       'IE',
    //       'FireFox',
    //       'Safari',
    //       'Opera',
    //       'Navigator',
    //   ],
    //   datasets: [
    //     {
    //       data: [700,500,400,600,300,100],
    //       backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    //     }
    //   ]
    // }
    // var donutOptions     = {
    //   maintainAspectRatio : false,
    //   responsive : true,
    // }
    // //Create pie or douhnut chart
    // // You can switch between pie and douhnut using the method below.
    // new Chart(donutChartCanvas, {
    //   type: 'doughnut',
    //   data: donutData,
    //   options: donutOptions
    // })

    // //-------------
    // //- PIE CHART -
    // //-------------
    // // Get context with jQuery - using jQuery's .get() method.
    // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    // var pieData        = donutData;
    // var pieOptions     = {
    //   maintainAspectRatio : false,
    //   responsive : true,
    // }
    // //Create pie or douhnut chart
    // // You can switch between pie and douhnut using the method below.
    // new Chart(pieChartCanvas, {
    //   type: 'pie',
    //   data: pieData,
    //   options: pieOptions
    // })

    // //-------------
    // //- BAR CHART -
    // //-------------
    // var barChartCanvas = $('#barChart').get(0).getContext('2d')
    // var barChartData = $.extend(true, {}, areaChartData)
    // var temp0 = areaChartData.datasets[0]
    // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp1
    // barChartData.datasets[1] = temp0

    // var barChartOptions = {
    //   responsive              : true,
    //   maintainAspectRatio     : false,
    //   datasetFill             : false
    // }

    // new Chart(barChartCanvas, {
    //   type: 'bar',
    //   data: barChartData,
    //   options: barChartOptions
    // })

    // //---------------------
    // //- STACKED BAR CHART -
    // //---------------------
    // var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    // var stackedBarChartData = $.extend(true, {}, barChartData)

    // var stackedBarChartOptions = {
    //   responsive              : true,
    //   maintainAspectRatio     : false,
    //   scales: {
    //     xAxes: [{
    //       stacked: true,
    //     }],
    //     yAxes: [{
    //       stacked: true
    //     }]
    //   }
    // }

    // new Chart(stackedBarChartCanvas, {
    //   type: 'bar',
    //   data: stackedBarChartData,
    //   options: stackedBarChartOptions
    // })
    

    // //---------------------
    // //- JUMLAH SALDO KAS -
    // //---------------------
    var data       = [],
        totalPoints = 100

    function getRandomData() {

      if (data.length > 0) {
        data = data.slice(1)
      }

      // Do a random walk
      while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y    = prev + Math.random() * 10 - 5

        if (y < 0) {
          y = 0
        } else if (y > 100) {
          y = 100
        }

        data.push(y)
      }

      // Zip the generated y values with the x values
      var res = []
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }

      return res
    }

    var interactive_KAS = $.plot('#saldoKas', [
        {
          data: getRandomData(),
        }
      ],
      {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: '#3c8dbc',
          lines: {
            lineWidth: 2,
            show: true,
            fill: true,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          show: true
        },
        xaxis: {
          show: true
        }
      }
    )

    var updateInterval = 500 //Fetch data ever x milliseconds
    var realtimeKAS    = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function updateSaldoKAS() {
      interactive_KAS.setData([getRandomData()])
      interactive_KAS.draw()
      if (realtimeKAS === 'on') {
        setTimeout(updateSaldoKAS, updateInterval)
      }
    }

    if (realtimeKAS === 'on') {
      updateSaldoKAS()
    }
  
    $('#realtimeKAS .btn').click(function () {
      if ($(this).data('toggle') === 'on') {
        realtimeKAS = 'on'
      }
      else {
        realtimeKAS = 'off'
      }
      updateSaldoKAS()
    })

    // //---------------------
    // //- SALDO REKENING BLU -
    // //---------------------
    var interactive_BLU = $.plot('#saldoBLU', [
        {
          data: getRandomData(),
        }
      ],
      {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: '#3c8dbc',
          lines: {
            lineWidth: 2,
            show: true,
            fill: true,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          show: true
        },
        xaxis: {
          show: true
        }
      }
    )
    var updateInterval = 500
    var realtimeBLU = 'on'
    
    function updateSaldoBLU() {
      interactive_BLU.setData([getRandomData()])
      interactive_BLU.draw()
      if (realtimeBLU === 'on') {
        setTimeout(updateSaldoBLU, updateInterval)
      }
    }

    if (realtimeBLU === 'on') {
      updateSaldoBLU()
    }
    $('#realtimeBLU .btn').click(function () {
      if ($(this).data('toggle') === 'on') {
        realtimeBLU = 'on'
      }
      else {
        realtimeBLU = 'off'
      }
      updateSaldoBLU()
    })
  })
</script>
@endsection
@endsection