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
		    <h4 class="card-title m-0 font-weight-bold text-primary">Profil User</h4>
		  </div>
	      <div>
	        @if(Session::has('message'))
	            <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
	            <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
	        @endif
	      </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <form role="form" id="ubahuser" method="post" action="{{url('proses-ubah-profil-user')}}" >
		  	{{ csrf_field() }}
	
			<div class="card-body">
				<div class="row">
				    <div class="col-md-6">
				    	<h5><b>Informasi Akun</b></h5>
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
				        <label>Email</label>
				        <input type="email" name="email" class="form-control" value="{{$user->email}}" id="txtEmail" placeholder="Email" required>
				      </div>	
				      <br>
				      <h5><b>Ubah Password</b></h5>
	             <div class="form-group">
                    <label>Password Baru</label>
                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
              </div>
               <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input id="password-confirm" type="password" placeholder="Konfirmasi Password"class="form-control" name="password_confirmation">
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