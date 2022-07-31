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
        <h5 class="m-0 font-weight-bold text-primary">Tambah Data Perusahaan</h5>
      </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <form role="form" id="tambahperusahaan" method="post" action="{{url('proses-tambah-perusahaan')}}" enctype="multipart/form-data">
		  	{{ csrf_field() }}
	
			<div class="card-body">
				<div class="row">
				    <div class="col-md-12">
				    <div class="row col-md-12">
				      <div class="form-group col-md-6">
				        <strong>Nama Perusahaan<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="nama_perusahaan" class="form-control" id="txtNamaPerusahaan" required>
				      </div>
							<div class="form-group col-md-6">
					        <strong>Kapasitas Produksi<a style="color:red;">&#42;</a></strong>
					        <input type="text" name="kapasitas_produksi" class="form-control" id="txtKapasitasProduksi" required>
					      </div>
				    </div>
				    <div class="row col-md-12">
				      <div class="form-group col-md-6">
				    		<strong>Alamat Perusahaan<a style="color:red;">&#42;</a></strong>
				       	<textarea name="alamat_perusahaan" style="width: 100%;" rows="1" class="form-control" required></textarea>
			      	</div>
							<div class="form-group col-md-6">
				        <strong>Bahan Baku<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="bahan_baku" class="form-control" id="txtBahanBaku" required>
				      </div>
			      </div>
				    <div class="row col-md-12">
			      	<div class="form-group col-md-6">
				        <strong>Jenis Usaha<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="jenis_usaha" class="form-control" id="txtJenisUsaha" required>
				      </div>
							<div class="form-group col-md-6">
				        <strong>Bahan Penolong<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="bahan_penolong" class="form-control" id="txtBahanPenolong" required>
				      </div>
				    </div>
				    <div class="row col-md-12">
					     	<div class="form-group col-md-6">
					        <strong>Nama Pemilik<a style="color:red;">&#42;</a></strong>
					        <input type="text" name="nama_pemilik" class="form-control" id="txtNamaPemilik" required>
					      </div>
							<div class="form-group col-md-6">
				        <strong>Peralatan<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="peralatan" class="form-control" id="txtPeralatan" required>
				      </div>
					  </div>
					  <div class="row col-md-12">
					     	<div class="form-group col-md-6">
					        <strong>Bentuk Badan Usaha<a style="color:red;">&#42;</a></strong>
					        <input type="text" name="bentuk_badan_usaha" class="form-control" id="txtBentukBadanUsaha" required>
					      </div>
					    	<div class="form-group col-md-6">
				        <strong>Cakupan Penjualan<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="cakupan_penjualan" class="form-control" id="txtCakupanPenjualan" required>
				      	</div>
					  </div>
					  <div class="row col-md-12">
					  	 	<div class="form-group col-md-6">
					        <strong>Jumlah Tenaga Kerja<a style="color:red;">&#42;</a></strong>
					        <input type="number" name="jumlah_tenaga_kerja" class="form-control" id="txtJumlahTenagaKerja" required>
					      </div>
					      <div class="form-group col-md-6">
						      	<strong>Surat Izin Usaha<a style="color:red;">&#42;</a></strong><br/>
		                <input type="file" name="surat_izin_usaha" id="suratizinusahaFile" required>
		            </div>
					  </div>
					  <div class="row col-md-12">
					  		<div class="form-group col-md-6">
					        <strong>Nilai Investasi<a style="color:red;">&#42;</a></strong>
					        <input type="number" name="nilai_investasi" class="form-control" id="txtNilaiInvestasi" required>
					      </div>
					      <div class="form-group col-md-6">
						      	<strong>NPWP<a style="color:red;">&#42;</a></strong><br/>
		                <input type="file" name="npwp" id="npwpFile" required>
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