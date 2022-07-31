@extends('layouts.dashboard')
@section('content')
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
	<!-- jquery validation -->
      <div>
        @if(Session::has('message'))
            <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
            <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
        @endif
      </div>
	 <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
       	<div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
          <div class="col-md-8">
          	<h5 class="m-0 font-weight-bold text-primary" style="text-align:justify;">{{$project_header->nama_perusahaan}} - {{$project_header->nama_project}}</h5>
          </div>
          <div class="col-md-4">
            <div class="text-right">
              <a href="{{url('tambah-survey-monitoring/'.$project_header->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"><i class="fas fa-plus-circle fa-sm"></i> Tambah SIMO</a> &nbsp;
              <a href="{{url('daftar-laporan/'.$project_header->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-outline-success shadow-sm"><i class="fas fa-file fa-sm"></i> Laporan</a>
            </div>
          </div>
      	</div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12">
                  @foreach($surveymonitoring as $data)
                    <div class="post clearfix">
                      <h6><strong>{{$data->jenis_kegiatan}}: {{$data->judul_kegiatan}} </strong>({{($data->tanggal_mulai == $data->tanggal_selesai) ? formatTanggalIndonesia($data->tanggal_mulai) : formatTanggalIndonesia($data->tanggal_mulai).' s/d '.formatTanggalIndonesia($data->tanggal_selesai)}})</h6>
                      <div class="user-block">
                        <span class="description" style="font-size:11pt;">
                          <i>Dibuat oleh <a style="color:#18176e;">{{$data->created_by}}</a></i>
                        </span>  
                        <span class="time float-right" style="font-size:9pt;"><i class="fas fa-clock"></i> {{$data->created_at}}  WIB
                        </span>
                      </div>

                      <p style="text-align:justify;">
                       {{$data->keterangan}}<br/>
                       Biaya kegiatan: {{formatRupiah($data->biaya)}}
                      </p>
                      <div>
                      Lampiran : 
                      @php
                        $lampiran = getLampiran($data->id);

                        if(count($lampiran)>0)
                        {
                          $no = 0;

                          foreach($lampiran as $val)
                          {
                            ++$no;
                      @endphp
                          <br/>
                          <i class="far fa-fw fa-file-pdf"></i> 
                          <a href="{{url('dokumen/project/'.$project_header->folder_project.'/'.$data->folder_survey_monitoring.'/'.$val->nama_file)}}" target="_blank" class="text-primary">{{$val->nama_file}}</a>
                      @php
                          }
                        }
                        else
                        {
                      @endphp
                          -
                      @php
                        }
                      @endphp 
                      </div>
                      <div class="float-right">
                      <a href="{{url('hapus-survey-monitoring/'.$data->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm swalDelete"><i class="fas fa-trash fa-sm"></i> Hapus</a>
                      </div>
                    </div>
                   <hr/>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h4 class="text-primary"> Budget: {{formatRupiah($anggaran['budget'])}}</h4>
              <h5 class="text-secondary"> Realisasi Anggaran</h5>
              <div class="progress">
                  <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                       aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $anggaran['persenrealisasi'];?>%">
                  </div>
              </div>
                 {{formatRupiah($anggaran['realisasi'])}} ({{$anggaran['persenrealisasi']}}%)
              <br>
              <hr/>
              <div class="text-muted">
                <p class="text-sm">Nama Perusahaan
                  <b class="d-block">{{$project_header->nama_perusahaan}}</b>
                </p>
                <p class="text-sm">Tim Project
                  @php
                  $no = 0;
                  foreach($project_detail as $data)
                  {
                  @endphp
                  <b class="d-block">{{++$no.'. '.$data->nama}} ({{$data->jabatan_project}})</b>
                  @php
                  }
                  @endphp
                </p>
              </div>

              <h5 class="mt-5 text-muted">File Project</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="{{url('dokumen/perusahaan/'.$project_header->surat_izin_usaha)}}" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-file-pdf "></i> Surat Izin Usaha</a>
                </li>
                <li>
                  <a href="{{url('dokumen/perusahaan/'.$project_header->npwp)}}" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-file-pdf"></i> NPWP</a>
                </li>
              </ul>

            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
	</div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function () {
	 
	  //DataTable
      $("#example1").DataTable({
        "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	      "responsive": true,
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


	  //datepicker
	  $('#datepickerawal').datepicker({
	      format: 'dd/mm/yyyy',
	      autoclose: true
		})

		$('#datepickerakhir').datepicker({
	      format: 'dd/mm/yyyy',
	      autoclose: true
		})

	});
</script>
@endsection