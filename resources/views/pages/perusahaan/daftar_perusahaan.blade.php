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
        <h5 class="m-0 font-weight-bold text-primary">Data Perusahaan</h5>
        <a href="{{url('tambah-perusahaan')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
      </div>
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jenis Usaha</th>
              <th>Nama Pemilik</th>
              <th>Bentuk Badan Usaha</th>
              <th>Jumlah Tenaga Kerja</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($perusahaan as $data)  
               <tr>
                  <td>{{++$no}}</td>
                  <td>{{$data->nama_perusahaan}}</td>
                  <td>{{$data->alamat_perusahaan}}</td>
                  <td>{{$data->jenis_usaha}}</td>
                  <td>{{$data->nama_pemilik}}</td>
                  <td>{{$data->bentuk_badan_usaha}}</td>
                  <td>{{$data->jumlah_tenaga_kerja}}</td>
                  <td width="15%">

                      <div class = "btn-group">
                        <a href = "profil-perusahaan/{{$data->id}}" class = "btn btn-sm btn-success shadow-sm" data-toggle="tooltip" data-placement="top" title="View">
                        <i class ="fas fa-eye"></i></a>
                      </div>
                  
                       <div class = "btn-group">
                        <a href = "ubah-perusahaan/{{$data->id}}" class = "btn btn-sm btn-primary shadow-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class ="fas fa-edit"></i></a>
                      </div>
                   
                      <div class = "btn-group">
                        <a href = "hapus-perusahaan/{{$data->id}}" class = "btn btn-sm btn-danger shadow-sm swalDelete" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class ="fas fa-trash"></i></a>
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
  });
  </script>
@endsection