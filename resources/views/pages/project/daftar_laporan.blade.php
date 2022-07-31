@extends('layouts.dashboard')
@section('content')
<style>
  #dropdown-action-id
  {
    min-width: 5rem;
  }

  #dropdown-action-id .dropdown-item:hover
  {
    color:#007bff;
  }

  #dropdown-action-id .dropdown-item:active
  {
    color:#fff;
  }
</style>
  <div class="row">
    <div class="col-12">
      <div>
        @if(Session::has('message'))
            <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
            <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
        @endif
      </div>
      <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <div class="col-md-8">
          <h5 class="m-0 font-weight-bold text-primary">Laporan Project: {{$project->nama_project}} di {{$project->nama_perusahaan}}</h5>
        </div>
        <div class="col-md-4">
          <div class="text-right">
            <a href="{{url('tambah-laporan/'.$project->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"><i class="fas fa-cog fa-sm"></i> Kelola Laporan</a>&nbsp;
          </div>
        </div>
      </div>
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row col-md-12">
             <div class="col-md-4">
              <div class="card card-outline">
                  <div class="card-header">
                    <h6 class="card-title"><i class="ion ion-erlenmeyer-flask" style="color:#007bff;"></i><b> Grafik Produktivitas</b></h6> 
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="lineChartProduktivitas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-outline">
                  <div class="card-header">
                    <h6 class="card-title"><i class="ion ion-erlenmeyer-flask" style="color:#007bff;"></i><b> Grafik Penjualan</b></h6> 
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="lineChartPenjualan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-outline">
                  <div class="card-header">
                    <h6 class="card-title"><i class="ion ion-erlenmeyer-flask" style="color:#007bff;"></i><b> Grafik Biaya Produksi</b></h6> 
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="lineChartBiayaProduksi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
              </div>
            </div>
          </div>
          <br/>
          <div class="col-md-12">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Bulan</th>
                  <th>Produktivitas (%)</th>
                  <th>Penjualan (Unit)</th>
                  <th>Biaya Produksi (Rp)</th>
                </tr>
                </thead>
                <tbody>
                @php
                $no = 0;
                @endphp
                @foreach($laporan as $data)  
                   <tr>
                      <td>{{++$no}}</td>
                      <td>{{getBulanIndonesia($data->bulan)}} {{$data->tahun}}</td>
                      <td>{{$data->produktivitas}}</td>
                      <td>{{$data->penjualan}}</td>
                      <td>{{formatRupiah($data->biaya_produksi)}}</td>
                   </tr>
                @endforeach
                </tbody>
              </table>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script>
    $( document ).ready(function () {

      //DataTable
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });


      //-------------
    //- PENGUJIAN -
    //-------------

    var lineChartDataProduktivitas = {
    labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [
        {
          label               : 'Produktivitas (%)',
          borderColor         : '#007bff',
          tension             : 0.1,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          fill                : false,
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$datagrafik[1]['produktivitas']}},{{$datagrafik[2]['produktivitas']}},{{$datagrafik[3]['produktivitas']}},{{$datagrafik[4]['produktivitas']}},{{$datagrafik[5]['produktivitas']}},{{$datagrafik[6]['produktivitas']}},{{$datagrafik[7]['produktivitas']}},{{$datagrafik[8]['produktivitas']}},{{$datagrafik[9]['produktivitas']}},{{$datagrafik[10]['produktivitas']}},{{$datagrafik[11]['produktivitas']}},{{$datagrafik[12]['produktivitas']}}]
        }
      ]
    }


    var lineChartCanvasProduktivitas= $('#lineChartProduktivitas').get(0).getContext('2d')

    var lineChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true,
      },
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
              }
          }]
       } 
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(lineChartCanvasProduktivitas, {
      type: 'line',
      data: lineChartDataProduktivitas,
      options: lineChartOptions
    })    


    var lineChartDataPenjualan = {
    labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [
        {
          label               : 'Penjualan (Unit)',
          borderColor         : '#1cc88a',
          tension             : 0.1,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          fill                : false,
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$datagrafik[1]['penjualan']}},{{$datagrafik[2]['penjualan']}},{{$datagrafik[3]['penjualan']}},{{$datagrafik[4]['penjualan']}},{{$datagrafik[5]['penjualan']}},{{$datagrafik[6]['penjualan']}},{{$datagrafik[7]['penjualan']}},{{$datagrafik[8]['penjualan']}},{{$datagrafik[9]['penjualan']}},{{$datagrafik[10]['penjualan']}},{{$datagrafik[11]['penjualan']}},{{$datagrafik[12]['penjualan']}}]
        }
      ]
    }


    var lineChartCanvasPenjualan= $('#lineChartPenjualan').get(0).getContext('2d')

    var lineChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true,
      },
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
              }
          }]
       } 
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(lineChartCanvasPenjualan, {
      type: 'line',
      data: lineChartDataPenjualan,
      options: lineChartOptions
    })    

    var lineChartDataBiayaProduksi= {
    labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [
        {
          label               : 'Biaya Produksi (Rp)',
          borderColor         : '#f6c23e',
          tension             : 0.1,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          fill                : false,
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$datagrafik[1]['biaya_produksi']}},{{$datagrafik[2]['biaya_produksi']}},{{$datagrafik[3]['biaya_produksi']}},{{$datagrafik[4]['biaya_produksi']}},{{$datagrafik[5]['biaya_produksi']}},{{$datagrafik[6]['biaya_produksi']}},{{$datagrafik[7]['biaya_produksi']}},{{$datagrafik[8]['biaya_produksi']}},{{$datagrafik[9]['biaya_produksi']}},{{$datagrafik[10]['biaya_produksi']}},{{$datagrafik[11]['biaya_produksi']}},{{$datagrafik[12]['biaya_produksi']}}]
        }
      ]
    }


    var lineChartCanvasBiayaProduksi= $('#lineChartBiayaProduksi').get(0).getContext('2d')

    var lineChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true,
      },
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
              }
          }]
       } 
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(lineChartCanvasBiayaProduksi, {
      type: 'line',
      data: lineChartDataBiayaProduksi,
      options: lineChartOptions
    })    



      //SweetAlert Delete
     $(document).on("click", ".swalDelete",function(event) {  
        event.preventDefault();
        const url = $(this).attr('href');

        Swal.fire({
          title: 'Apakah anda yakin menghapus data ini?',
          text: 'Anda tidak akan dapat mengembalikan data ini!',
          icon: 'error',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.value) 
        {
            window.location.href = url;
        }
      });
    });

      //SweetAlert Success
      var message = $("#idmessage").val();
      var message_text = $("#idmessage_text").val();

      if(message=="1")
      {
        Swal.fire({     
           icon: 'success',
           title: 'Success!',
           text: message_text,
           showConfirmButton: false,
           timer: 1500
        })
      }
  });
  </script>
@endsection