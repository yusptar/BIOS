@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Dashboard Pendukung</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Maturity Rating</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body ">
                <div class="chart">
                  <div>
                    <div class="col-md-6" style="display: flex; justify-content:center; margin-top:20px; margin-right:10%; margin-left:10%">
                      <img src="{{ asset('img/hexagonal.png')}}" alt="" width="60%" height="40%">
                        <div class="col-md-6">
                          <table border="1" style="margin-left:50%; margin-top:30%; ">
                            <tr>
                                <th style="text-align:center; padding: 15px; ">Keuangan</th>
                                <th style="text-align:center; padding: 15px; ">Pelayanan</th>
                                <th style="text-align:center; padding: 15px; ">Kapabilitas Internal</th>
                                <th style="text-align:center; padding: 15px; ">Tata Kelola & Kepemimpinan</th>
                                <th style="text-align:center; padding: 15px; ">Inovasi</th>
                                <th style="text-align:center; padding: 15px; ">Lingkungan</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 15px; background-color: rgb(239, 119, 74);">2.38</th>
                                <th style="text-align:center; padding: 15px; background-color: rgb(244, 209, 102);">2.90</th>
                                <th style="text-align:center; padding: 15px; background-color: rgb(244, 209, 102);">3.25</th>
                                <th style="text-align:center; padding: 15px; background-color: rgb(244, 209, 102);">3.00</th>
                                <th style="text-align:center; padding: 15px; background-color: rgb(244, 209, 102);">2.75</th>
                                <th style="text-align:center; padding: 15px; background-color: rgb(239, 119, 74);">2.50</th>
                            </tr>
                          </table>
                        </div>
                    </div>
                  <div>
                  <br>
                  <div style="display: flex; justify-content:center;">
                    <div>
                        <table border="1">
                            <tr>
                                <th style="text-align:center; padding: 51px;">1.1 Likuiditias</th>
                                <th style="text-align:center; padding: 8px; background-color: rgb(190, 42, 62); color:white;">1.00</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 55px;">1.2 Efisiensi</th>
                                <th style="text-align:center; padding: 8px; background-color: rgb(94, 156, 164); color:white;">3.50</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 55px;">1.3 Efektivitas</th>
                                <th style="text-align:center; padding: 8px; background-color: rgb(190, 42, 62); color:white;">1.00</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 55px;">1.4 Tingkat<br>Kemandirian<br></th>
                                <th style="text-align:center; padding: 8px; background-color: rgb(94, 156, 164); color:white;">4.00</th>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-left:5px">
                        <table border="1">
                            <tr>
                                <th style="text-align:center; padding: 27px;">2.1 Indeks<br>Kepuasan<br>Masyarakat</th>
                                <th style="text-align:center; padding: 8px;">2.00</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 31px;">2.2 Efisiensi<br>Waktu<br>Pelayanan</th>
                                <th style="text-align:center; padding: 8px;">1.50</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 31px;">2.3 Sistem<br>Pengaduan<br>Layanan</th>
                                <th style="text-align:center; padding: 8px;">3.33</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 31px;">2.4 Tingkat<br>Keberhasilan<br>Pemenuhan<br>Layanan</th>
                                <th style="text-align:center; padding: 8px;">4.75</th>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-left:5px">
                        <table border="1">
                            <tr>
                                <th style="text-align:center; padding: 39px;">3.1 Sumber<br>Daya Manusia</th>
                                <th style="text-align:center; padding: 8px;">2.00</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 43px;">3.2 Proses<br>Bisnis</th>
                                <th style="text-align:center; padding: 8px;">1.50</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 55px;">3.3 Teknologi</th>
                                <th style="text-align:center; padding: 8px;">3.33</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 55px;">3.4 Customer<br>Focus</th>
                                <th style="text-align:center; padding: 8px;">4.75</th>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-left:5px">
                        <table border="1">
                            <tr>
                                <th style="text-align:center; padding: 27px;">4.1 Perencanaan<br>Strategis</th>
                                <th style="text-align:center; padding: 8px;">2.00</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 31px;">4.2 Etika<br>Bisnis</th>
                                <th style="text-align:center; padding: 8px;">1.50</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 31px;">4.3 Stakeholder<br>Relationship</th>
                                <th style="text-align:center; padding: 8px;">3.33</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 31px;">4.4 Manajemen<br>Risiko</th>
                                <th style="text-align:center; padding: 8px;">4.75</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 23px;">4.5 Pengawasan<br>dan<br>Pengendalian</th>
                                <th style="text-align:center; padding: 8px;">4.75</th>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-left:5px">
                        <table border="1">
                            <tr>
                                <th style="text-align:center; padding: 39px;">5.1 Keterlibatan<br>Penggunaan Jasa</th>
                                <th style="text-align:center; padding: 8px;">2.00</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 43px;">5.2 Proses<br>Inovasi</th>
                                <th style="text-align:center; padding: 8px;">1.50</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 48px;">5.3 Manajemen<br>Pengetahuan</th>
                                <th style="text-align:center; padding: 8px;">3.33</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 49px;">5.4 Manajemen<br>Perubahan</th>
                                <th style="text-align:center; padding: 8px;">4.75</th>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-left:5px">
                        <table border="1">
                            <tr>
                                <th style="text-align:center; padding: 135px 108px 80px 80px;">6.1 Enviromental<br>Footprint<br>Management</th>
                                <th style="text-align:center; padding: 8px;">2.00</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; padding: 135px 108px 80px 80px;">6.2 Penggunaan<br>Sumber Daya</th>
                                <th style="text-align:center; padding: 8px;">1.50</th>
                            </tr>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@section('script')
<script>
  $(function () {
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
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
          data                : [28, 48, 40, 19, 86, 27, 90]
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

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
@endsection
@endsection