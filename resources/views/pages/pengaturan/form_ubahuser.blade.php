@extends('layouts.dashboard')
@section('page_heading','User')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{url('user')}}">User</a></li>
  <li class="breadcrumb-item active">Ubah User</li>
</ol>
@endsection
@section('content')
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
	<!-- jquery validation -->
		<div class="card card-primary">
		  <div class="card-header">
		    <h3 class="card-title">Ubah Data</h3>
		  </div>
	      <div>
	        @if(Session::has('message'))
	            <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
	            <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
	        @endif
	      </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <form role="form" id="ubahuser" method="post" action="{{url('prosesubahuser')}}" >
		  	{{ csrf_field() }}
	
			<div class="card-body">
				<div class="row">
				    <div class="col-md-6">
				    	<input type="hidden" name="id" class="form-control" id="txtID" value="{{$user->id}}"></input>

				      <div class="form-group">
				        <label>Nama</label>
				        <input type="text" name="name" class="form-control" value="{{$user->name}}" id="txtName" placeholder="Nama" readonly>
				      </div>
			      	<div class="form-group">
				        <label>Username</label>
				        <input type="text" name="username" class="form-control" value="{{$user->username}}" id="txtUsername" placeholder="Username" readonly>
				      </div>
				      <div class="form-group">
					        <label>Role</label>
					        <select name="role" class="form-control select2bs4" style="width: 100%;">
	                    <option value="" selected="selected">-- Pilih Satu --</option>
	                    @foreach($role as $data)
	                        <option value="{{$data->id}}" @if($data->id == $user->role_id) selected @endif>{{$data->name}}</option>
	                    @endforeach
			            </select>
					    </div>		
						</div>
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer">
		      <button type="submit" class="btn btn-primary">Simpan</button>
		    </div>
			
	  	</form>
		</div>
        <!-- /.row -->
	</div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function () {
	  $('#tambahkodearsip').validate({
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