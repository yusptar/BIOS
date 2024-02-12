@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Dashboard Layanan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <!-- AREA CHART -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><strong>Kinerja Layanan</strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>

            <!-- DONUT CHART -->
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title"><strong>Jumlah Pengguna Layanan</strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="bar2Chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title"><strong>Trend Pemberian Layanan</strong></h3>

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
            </div>

            <!-- BAR CHART -->
            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title"><strong>Hasil Survey Penggunaan Layanan</strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="bar1Chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
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
    //-------------
    //- HASIL SURVEY PENGGUNAAN LAYANAN -
    //-------------
    var bar1Canvas = $('#bar1Chart').get(0).getContext('2d')
    var bar1Data = {
      labels  : <?php echo json_encode($months); ?>,
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [100, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var bar1Options = {
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

    var bar1Data = $.extend(true, {}, bar1Data)
    var temp0 = bar1Data.datasets[0]
    var temp1 = bar1Data.datasets[1]
    bar1Data.datasets[0] = temp1
    bar1Data.datasets[1] = temp0

    var bar1Options = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(bar1Canvas, {
      type: 'bar',
      data: bar1Data,
      options: bar1Options
    })

    //-------------
    //- JUMLAH PENGGUNAAN LAYANAN -
    //-------------
    var bar2Canvas = $('#bar2Chart').get(0).getContext('2d')
    // Data dari backend
    var ralanData = <?php echo json_encode($ralan); ?>;
    var ranapData = <?php echo json_encode($ranap); ?>;
    var radiologiData = <?php echo json_encode($radiologi); ?>;

    // Struktur data yang diharapkan oleh chart.js
    var chartData = {
      labels: <?php echo json_encode($months); ?>,
      datasets: [
        {
          label: 'Ralan',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: ralanData.map(item => item.total)
        },
        {
          label: 'Ranap',
          backgroundColor: 'rgba(210, 214, 222, 1)',
          borderColor: 'rgba(210, 214, 222, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: ranapData.map(item => item.total)
        },
        {
          label: 'Radiologi',
          backgroundColor: 'black',
          borderColor: 'black',
          pointRadius: false,
          pointColor: 'black',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: radiologiData.map(item => item.total)
        }
      ]
    };

    var bar2Options = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    };

    var bar2Options = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(bar2Canvas, {
      type: 'bar',
      data: chartData,
      options: bar2Options
    });

    //-------------
    //- TREND PEMBERIAN LAYANAN -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')

    var ralanData = <?php echo json_encode($ralan); ?>;
    var ranapData = <?php echo json_encode($ranap); ?>;
    var radiologiData = <?php echo json_encode($radiologi); ?>;
    var lineChartData = {
      labels  :  <?php echo json_encode($months); ?>,
      datasets: [
        {
          label: 'Ralan',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: ralanData.map(item => item.total)
        },
        {
          label: 'Ranap',
          backgroundColor: 'rgba(210, 214, 222, 1)',
          borderColor: 'rgba(210, 214, 222, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: ranapData.map(item => item.total)
        },
        {
          label: 'Radiologi',
          backgroundColor: 'black',
          borderColor: 'black',
          pointRadius: false,
          pointColor: 'black',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: radiologiData.map(item => item.total)
        }
        // Add more datasets as needed
      ]
    }

    var lineChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }

    var lineChartOptions = $.extend(true, {}, lineChartOptions)
    var lineChartData = $.extend(true, {}, lineChartData)
    lineChartData.datasets.forEach(dataset => {
      dataset.fill = false;
    })

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })
  })
</script>
@endsection
@endsection
