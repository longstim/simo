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
        <h5 class="m-0 font-weight-bold text-primary">Data Project</h5>
      </div>
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama Project</th>
              <th>Tanggal</th>
              <th>Nama Perusahaan</th>
              <th>Jenis Project</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($newProject as $data)  
               <tr>
                  <td>{{++$no}}</td>
                  <td>{{$data->nama_project}}</td>
                  <td>{{formatTanggalIndonesia($data->tanggal_mulai)}} s/d {{formatTanggalIndonesia($data->tanggal_selesai)}}</td>
                  <td>{{$data->nama_perusahaan}}</td>
                  <td>{{$data->jenis_project}}</td>
                  @if($data->status=="Selesai")
                    <td><span class="badge bg-success text-white">{{$data->status}}</span></td>
                  @else
                    <td><span class="badge bg-warning text-white">{{$data->status}}</span></td>
                  @endif
                  <td width="20%">
                      <div class = "btn-group">
                        <a href = "survey-monitoring/{{$data->id}}" class = "d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="tooltip" data-placement="top" title="Survey/Monitoring">
                        <i class="fas fa-search fa-sm text-white-50"></i> Survey/Monitoring</a>
                      </div>
                  </td>
               </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script>
    $( document ).ready(function () {

      //DataTable
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });


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