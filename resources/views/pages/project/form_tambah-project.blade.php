@extends('layouts.dashboard')
@section('content')
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
	<!-- jquery validation -->
		<div class="card card-outline card-info">
	      <div>
	        @if(Session::has('message'))
	            <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
	            <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
	        @endif
	      </div>

	     <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Tambah Data Project</h5>
      </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <form role="form" id="tambahproject" method="post" action="{{url('proses-tambah-project')}}" enctype="multipart/form-data">
		  	{{ csrf_field() }}
	
			<div class="card-body">
				<div class="row">
				    <div class="col-md-12">
				    <div class="row col-md-12">
				      <div class="form-group col-md-6">
				        <strong>Nama Project<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="nama_project" class="form-control" id="txtNamaProject" required>
				      </div>
				    </div>
				    <div class="row col-md-12">
							<div class="form-group col-md-6">
				        <strong>Perusahaan<a style="color:red;">&#42;</a></strong>
				        <select name="perusahaan" class="form-control select2bs4" id="perusahaanSlc" style="width: 100%;" required>
                    <option value="" selected="selected">-- Pilih Satu --</option>
                    @foreach($perusahaan as $data)
                        <option value="{{$data->id}}">{{$data->nama_perusahaan}}</option>
                    @endforeach
		            </select>
				      </div>
			      </div>
				    <div class="row col-md-12">
			      	<div class="form-group col-md-6">
				        <strong>Jenis Project<a style="color:red;">&#42;</a></strong>
				        <select name="jenis_project" class="form-control select2bs4" id="jenis_projectSlc" style="width: 100%;" required>
                    <option value="" selected="selected">-- Pilih Satu --</option>
                    <option value="DAPATI">DAPATI</option>
                    <option value="PINOTI">PINOTI</option>
		            </select>
				      </div>
				    </div>
				    <div class="row col-md-12">
				      <div class="form-group col-md-4">
				        <strong>Tanggal Mulai<a style="color:red;">&#42;</a></strong>
					       <div class="input-group date">
		                  <input type="text" name="tanggal_mulai" class="form-control" id="datepicker" placeholder="dd/mm/yyyy" value="{{date('d/m/Y')}}" required>
		                  <div class="input-group-prepend">
		                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
		                  </div>
		               </div>
		            </div>
				    </div>
				    <div class="row col-md-12">
				      <div class="form-group col-md-4">
				        <strong>Tanggal Selesai<a style="color:red;">&#42;</a></strong>
					       <div class="input-group date">
		                  <input type="text" name="tanggal_selesai" class="form-control" id="datepicker2" placeholder="dd/mm/yyyy" value="{{date('d/m/Y')}}" required>
		                  <div class="input-group-prepend">
		                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
		                  </div>
		               </div>
		            </div>
				    </div>
				    <div class="row col-md-12">
				      <div class="form-group col-md-6">
				        <strong>Budget<a style="color:red;">&#42;</a></strong>
				        <input type="number" name="budget" class="form-control" id="txtBudget" required>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer" style="margin-left:10px;">
		      <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan</button>
		  </div>
			
	  	</form>
		</div>
        <!-- /.row -->
	</div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function () {

		//datepicker
	  $('#datepicker2').datepicker({
	      format: 'dd/mm/yyyy',
	      autoclose: true
		});

	  $('#tambahperusahaan').validate({
	    rules: {
	      nama: {
	        required: true
	      },
	      nama_arsip: {
	        required: true
	      },
	      aktif: {
	        required: true,
	        number:true
	      },
	      inaktif: {
	        required: true,
	        number:true
	      },
	    },
	    messages: {
	      nama: {
	        required: "Nama Pegawai harus diisi."
	      },
	      nama_arsip: {
	        required: "Nama Arsip harus diisi."
	      },
	      aktif: {
	        required: "Aktif harus diisi.",
	        number: "Aktif harus diisi dengan angka."
	      },
	      inaktif: {
	        required: "Inaktif harus diisi.",
	        number: "Inaktif harus diisi dengan angka."
	      },
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	  });

	  //DataTable
      $("#detailtable").DataTable({
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


	  //datepicker
	  $('#datepicker').datepicker({
	      format: 'dd/mm/yyyy',
	      autoclose: true
		})

	});

</script>
@endsection