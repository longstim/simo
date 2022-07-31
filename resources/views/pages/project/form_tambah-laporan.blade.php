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
        <h5 class="m-0 font-weight-bold text-primary">Laporan: {{$project->nama_project}} di {{$project->nama_perusahaan}}</h5>
      </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <form role="form" id="tambahlaporan" method="post" action="{{url('proses-tambah-laporan')}}">
		  	{{ csrf_field() }}
	
			<div class="card-body">
				<div class="row">
					<input type="hidden" name="id_project" class="form-control" id="txtIDProject" value="{{$project->id}}">
				    <div class="col-md-12">
				    <div class="row col-md-12">
				      <div class="form-group col-md-3">
				        <strong>Bulan<a style="color:red;">&#42;</a></strong>
				        <select name="bulan" class="form-control select2bs4" style="width: 100%;" required>
		                    <option value="" selected="selected">-- Pilih Satu --</option>
		                    <option value="1">Januari</option>
		                    <option value="2">Februari</option>
		                    <option value="3">Maret</option>
		                    <option value="4">April</option>
		                    <option value="5">Mei</option>
		                    <option value="6">Juni</option>
		                    <option value="7">Juli</option>
		                    <option value="8">Agustus</option>
		                    <option value="9">September</option>
		                    <option value="10">Oktober</option>
		                    <option value="11">November</option>
												<option value="12">Desember</option>
		             </select>
				      </div>
				      <div class="form-group col-md-3">
				        <strong>Tahun<a style="color:red;">&#42;</a></strong>
				             <select name="tahun" class="form-control select2bs4" style="width: 100%;" required>
		                    <option value="" selected="selected">-- Pilih Satu --</option>
		                    <option value="2022">2022</option>
		             </select>
				      </div>
				    </div>
				   <div class="row col-md-12">
				   	<div class="form-group col-md-4">
				   	 <strong>Produktivitas<a style="color:red;">&#42;</a></strong>
				     <div class="input-group mb-3">
							  <input type="number" name="produktivitas" class="form-control" aria-describedby="basic-addon2" required>
							  <div class="input-group-append">
							    <span class="input-group-text" id="basic-addon2">%</span>
							  </div>
							</div>
						</div>
				   </div>
				    <div class="row col-md-12">
				   	<div class="form-group col-md-4">
				   	 <strong>Penjualan<a style="color:red;">&#42;</a></strong>
				     <div class="input-group mb-3">
							  <input type="number" name="penjualan" class="form-control" aria-describedby="basic-addon2" required>
							  <div class="input-group-append">
							    <span class="input-group-text" id="basic-addon2">Unit</span>
							  </div>
							</div>
						</div>
				   </div>
				    <div class="row col-md-12">
				   	<div class="form-group col-md-4">
				   	 <strong>Biaya Produksi<a style="color:red;">&#42;</a></strong>
				     <div class="input-group mb-3">
							  <input type="number" name="biaya_produksi" class="form-control" aria-describedby="basic-addon2" required>
							  <div class="input-group-append">
							    <span class="input-group-text" id="basic-addon2">Rp</span>
							  </div>
							</div>
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

		$("#btn-add").click(function(){ 
          var lsthmtl = $("#body-upload").html();
          $(".increment").after(lsthmtl);
      });

	  $('#tambahperusahaan').validate({
	    rules: {
	      nama: {
	        required: true
	      },
	    },
	    messages: {
	      nama: {
	        required: "Nama Pegawai harus diisi."
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

	});

</script>
@endsection