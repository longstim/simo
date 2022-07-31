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
        <h5 class="m-0 font-weight-bold text-primary">Form Survey/Monitoring: {{$project->nama_project}} di {{$project->nama_perusahaan}}</h5>
      </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <form role="form" id="tambahsurveymonitoring" method="post" action="{{url('proses-tambah-survey-monitoring')}}" enctype="multipart/form-data">
		  	{{ csrf_field() }}
	
			<div class="card-body">
				<div class="row">
					<input type="hidden" name="id_project" class="form-control" id="txtIDProject" value="{{$project->id}}">
				    <div class="col-md-12">
				    <div class="row col-md-12">
				      <div class="form-group col-md-6">
				        <strong>Judul Kegiatan<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="judul_kegiatan" class="form-control" id="txtJudulKegiatan" required>
				      </div>
				    </div>
				    <div class="row col-md-12">
			      	<div class="form-group col-md-6">
				        <strong>Jenis Kegiatan<a style="color:red;">&#42;</a></strong><br/>
				        <div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="jenis_kegiatan" id="jenisKegiatanRadioSurvey" value="Survey" required>
								  <label class="form-check-label" for="jenisKegiatanRadioSurvey"> Survey</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="jenis_kegiatan" id="jenisKegiatanRadioMonitoring" value="Monitoring" required>
								  <label class="form-check-label" for="jenisKegiatanRadioMonitoring"> Monitoring</label>
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
				    		<strong>Keterangan<a style="color:red;">&#42;</a></strong>
				       	<textarea name="keterangan" style="width: 100%;" rows="3" class="form-control" required></textarea>
			      	</div>
			     	</div>
				   </div>
				   <div class="row col-md-12">
				      <div class="form-group col-md-6">
				        <strong>Biaya<a style="color:red;">&#42;</a></strong>
				        <input type="number" name="biaya" class="form-control" id="txtJudulBiaya" required>
				      </div>
				   </div>

				   <div class="row col-md-12">
				   	 <div class="form-group col-md-6">
						    <div class="input-group hdtuto control-group lst increment" >
						      <div class="input-group-btn"> 
						      	<strong>Lampiran</strong>
						        <button class="-none d-sm-inline-block btn btn-sm btn-outline-success shadow-sm" id="btn-add" type="button"><i class="fas fa-upload fa-sm"></i> Tambah Lampiran</button>
						      </div>
					    	</div>
						    <div class="clone hide" id="body-upload">
						      <div class="hdtuto control-group lst input-group" style="margin-top:10px">
						        <input type="file" name="filenames[]">
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