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
        <h5 class="m-0 font-weight-bold text-primary">Edit Data Project</h5>
      </div>
		  <!-- /.card-header -->
		  <!-- form start -->
		  <form role="form" id="ubahproject" method="post" action="{{url('proses-ubah-project')}}" enctype="multipart/form-data">
		  	{{ csrf_field() }}
	
			<div class="card-body">
				<div class="row">
				   <div class="col-md-12">
				   	<input type="hidden" name="id_header" class="form-control" id="txtIDHeader" value="{{$project_header->id}}">
				    <div class="row col-md-12">
				      <div class="form-group col-md-6">
				        <strong>Nama Project<a style="color:red;">&#42;</a></strong>
				        <input type="text" name="nama_project" class="form-control" id="txtNamaProject" value="{{$project_header->nama_project}}" required>
				      </div>
				    </div>
				    <div class="row col-md-12">
							<div class="form-group col-md-6">
				        <strong>Perusahaan<a style="color:red;">&#42;</a></strong>
				        <select name="perusahaan" class="form-control select2bs4" id="perusahaanSlc" style="width: 100%;" required>
                    <option value="" selected="selected">-- Pilih Satu --</option>
                    @foreach($perusahaan as $data)
                          <option value="{{$data->id}}" @if($data->id == $project_header->id_perusahaan) selected @endif>{{$data->nama_perusahaan}}</option>
                    @endforeach
		            </select>
				      </div>
			      </div>
				    <div class="row col-md-12">
			      	<div class="form-group col-md-6">
				        <strong>Jenis Project<a style="color:red;">&#42;</a></strong>
				        <select name="jenis_project" class="form-control select2bs4" id="jenis_projectSlc" style="width: 100%;" required>
                    <option value="" selected="selected">-- Pilih Satu --</option>
                    <option value="DAPATI"  @if($project_header->jenis_project == "DAPATI") selected @endif>DAPATI</option>
                    <option value="PINOTI" @if($project_header->jenis_project == "PINOTI") selected @endif>PINOTI</option>
		            </select>
				      </div>
				    </div>
				    <div class="row col-md-12">
				      <div class="form-group col-md-4">
				        <strong>Tanggal Mulai<a style="color:red;">&#42;</a></strong>
					       <div class="input-group date">
		                  <input type="text" name="tanggal_mulai" class="form-control" value="{{date('d/m/Y', strtotime($project_header->tanggal_mulai))}}" id="datepicker" placeholder="dd/mm/yyyy" value="{{date('d/m/Y', strtotime(now()))}}" required>
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
		                  <input type="text" name="tanggal_selesai" class="form-control" id="datepicker2" value="{{date('d/m/Y', strtotime($project_header->tanggal_selesai))}}" placeholder="dd/mm/yyyy" value="{{date('d/m/Y', strtotime(now()))}}" required>
		                  <div class="input-group-prepend">
		                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
		                  </div>
		               </div>
		            </div>
				    </div>
				    <div class="row col-md-12">
				      <div class="form-group col-md-6">
				        <strong>Budget<a style="color:red;">&#42;</a></strong>
				        <input type="number" name="budget" class="form-control" id="txtBudget" value="{{$project_header->budget}}" required>
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
       <br/><br/>
      <div class="row" id="detailrow">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
			        	<h6 class="m-0 font-weight-bold text-primary">Tim Project</h6>
			        	<a href="{{url('tambah-project-detail/'.$project_header->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#modal-detail"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Personil</a>
            </div>
            <div class="card-body">
           	<table id="detailtable" class="table table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Pendidikan</th>
                    <th>Posisi</th>
                    <th>Tugas dan Tanggung Jawab</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
	            @php
	            $no = 0
	            @endphp
	            @foreach($project_detail as $data)  
	               <tr>
	                  <td>{{++$no}}</td>
	                  <td>{{$data->nama_pegawai}}</td>
	                  <td>{{$data->jenjang_jabatan}} - {{$data->jabatan}}</td>
	                  <td>{{$data->tingkat_pendidikan}} {{$data->jurusan}}</td>
	                  <td>{{$data->jabatan_project}}</td>
	                  <td>{{$data->tugas}}</td>
	                  <td width="10%">
                       <div class = "btn-group">
                        <a href="#" data-toggle="modal" data-target="#modal-detail2" onclick ="dataprojectdetail({{$data->id}})" class = "btn btn-sm btn-primary shadow-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class ="fas fa-edit"></i></a>
                      </div>
                   
                      <div class = "btn-group">
                        <a href = "{{url('hapus-project-detail/'.$project_header->id.'/'.$data->id)}}" class="btn btn-sm btn-danger shadow-sm swalDelete" data-toggle="tooltip" data-placement="top" title="Hapus">
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
      </div>
      <!-- /.row -->
	</div>

<!-- Modal Tambah Detail -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="row">
			<!-- left column -->
			<div class="col-md-12">
			<!-- jquery validation -->
				<div class="card card-primary">
				   <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
		        	<h6 class="m-0 font-weight-bold text-primary">Tambah Data Personil</h6>
		     	 </div>
				  <!-- /.card-header -->
				  <!-- form start -->
				  <form role="form" id="tambahprojectdetail" method="post" action="{{url('proses-tambah-project-detail')}}" >
				  	{{ csrf_field() }}
			
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
					        	
					          <input type="hidden" name="id_header" class="form-control" id="txtIDHeader" value="{{$project_header->id}}"></input>

						      <div class="form-group">
						        <strong>Nama Pegawai<a style="color:red;">&#42;</a></strong>
						        <select name="pegawai" class="form-control select2bs4" onchange="datapegawai(this.value)" style="width: 100%;" id="slcPegawai" required>
				                    <option value="" selected="selected">-- Pilih Satu --</option>
				                    @foreach($pegawai as $data)
				                        <option value="{{$data->id}}">{{$data->nama}}</option>
				                    @endforeach
				                </select>
						      </div>
						      <div class="form-group">
						        <strong>Jabatan<a style="color:red;">&#42;</a></strong>
						        <input type="text" name="jabatan" class="form-control" id="txtJabatan" readonly>
						      </div>
						      <div class="form-group">
						        <strong>Pendidikan<a style="color:red;">&#42;</a></strong>
						        <input type="text" name="pendidikan" class="form-control" id="txtPendidikan" readonly>
						      </div>
						    </div>
						    <div class="col-md-6">
							    <div class="form-group">
							      	<strong>Posisi<a style="color:red;">&#42;</a></strong>
							        <input type="text" name="jabatan_project" class="form-control" id="txtJabatanProject" required>
							    </div>

							    <div class="form-group">
							      	<strong>Tugas dan Tanggung Jawab<a style="color:red;">&#42;</a></strong>
							        <textarea name="tugas" class="form-control" id="txtTugas" rows="2" required></textarea>
							    </div>
							</div>
						</div>
					</div>
						    <!-- /.card-body -->
				    <div class="card-footer">
				      <button type="submit" id="simpandetail" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan</button>
				    </div>
			  	</form>
				</div>
			</div>
		</div>
      </div>
    </div>
</div>
</div>
<!-- Modal Tambah Detail-->

<!-- Modal Ubah Detail -->
<div class="modal fade" id="modal-detail2">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="row">
			<!-- left column -->
			<div class="col-md-12">
			<!-- jquery validation -->
				<div class="card card-primary">
				  <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
		        	<h6 class="m-0 font-weight-bold text-primary">Edit Data Personil</h6>
		     	 </div>
				  <!-- /.card-header -->
				  <!-- form start -->
				  <form role="form" id="ubahprojectdetail" method="post" action="{{url('proses-ubah-project-detail')}}" >
				  	{{ csrf_field() }}
			
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
					        	
					        <input type="hidden" name="id_header2" class="form-control" id="txtIDHeader" value="{{$project_header->id}}"></input>

					        <input type="hidden" name="id_detail2" class="form-control" id="txtIDDetail2"></input>

						      <div class="form-group">
						        <strong>Nama Pegawai<a style="color:red;">&#42;</a></strong>
						        <select name="pegawai2" class="form-control select2bs4" onchange="datapegawai2(this.value)" style="width: 100%;"  id="slcPegawai2" required>
				                    <option value="" selected="selected">-- Pilih Satu --</option>
				                    @foreach($pegawai as $data)
				                        <option value="{{$data->id}}">{{$data->nama}}</option>
				                    @endforeach
				             </select>
						      </div>
						      <div class="form-group">
						        <strong>Jabatan<a style="color:red;">&#42;</a></strong>
						        <input type="text" name="jabatan2" class="form-control" id="txtJabatan2" readonly>
						      </div>
						      <div class="form-group">
						        <strong>Pendidikan<a style="color:red;">&#42;</a></strong>
						        <input type="text" name="pendidikan2" class="form-control" id="txtPendidikan2" readonly>
						      </div>
						    </div>
						    <div class="col-md-6">
							    <div class="form-group">
							      	<strong>Posisi<a style="color:red;">&#42;</a></strong>
							        <input type="text" name="jabatan_project2" class="form-control" id="txtJabatanProject2" required>
							    </div>

							    <div class="form-group">
							      	<strong>Tugas dan Tanggung Jawab<a style="color:red;">&#42;</a></strong>
							        <textarea name="tugas2" class="form-control" id="txtTugas2" rows="2" required></textarea>
							    </div>
							</div>
						</div>
					</div>
						    <!-- /.card-body -->
				    <div class="card-footer">
				      <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan</button>
				    </div>
			  	</form>
				</div>
			</div>
		</div>
      </div>
    </div>
</div>
<!-- Modal Ubah Detail-->

<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function () {

		$('#datepicker2').datepicker({
	      format: 'dd/mm/yyyy',
	      autoclose: true
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

	function datapegawai(id_pegawai)
  {
	    //alert(id_pegawai);
	    if(id_pegawai!="")
	    {
	      $.ajax({
		        url: '../jsondatapegawai/'+id_pegawai,
		        type : 'GET',
		        datatype: "json",
		        success:function(data)
		        {
		          //alert(data);
		          var output = JSON.parse(data);
		          console.log(output);

	              $("#txtJabatan").val(output.jabatan);
	              $("#txtPendidikan").val(output.pendidikan);
		        } 
	      	});
	    }
	    else
	    {
	      	$("#txtJabatan").val("");
	      	$("#txtPendidikan").val("");
	    }
  	}

  function datapegawai2(id_pegawai)
  {
	    //alert(id_pegawai);
	    if(id_pegawai!="")
	    {
	      $.ajax({
		        url: '../jsondatapegawai/'+id_pegawai,
		        type : 'GET',
		        datatype: "json",
		        success:function(data)
		        {
		          //alert(data);
		          var output = JSON.parse(data);
		          console.log(output);

	              $("#txtJabatan2").val(output.jabatan);
	              $("#txtPendidikan2").val(output.pendidikan);
		        } 
	      	});
	    }
	    else
	    {
	      	$("#txtJabatan2").val("");
	      	$("#txtPendidikan2").val("");
	    }
  }

  function dataprojectdetail(id_projectdetail)
   	{
	    //alert(id_projectdetail);
	    if(id_projectdetail!="")
	    {
	      $.ajax({
		        url: '../jsondataprojectdetail/'+id_projectdetail,
		        type : 'GET',
		        datatype: "json",
		        success:function(data)
		        {
		          //alert(data);
		          var output = JSON.parse(data);
		          console.log(output);

		            $("#txtIDDetail2").val(output.id);
              	$("#slcPegawai2").val(output.id_pegawai).change();
	              $("#txtJabatan2").val(output.jabatan);
	              $("#txtPendidikan2").val(output.pendidikan);
	              $("#txtJabatanProject2").val(output.jabatan_project)
	              $("#txtTugas2").val(output.tugas)
		        } 
	      	});
	    }
	    else
	    {
	      	$("#txtJabatan2").val("");
	      	$("#txtPendidikan2").val("");
	      	$("#txtJabatanProject2").val("")
	      	$("#txtTugas2").val("")
	    }
  	}

</script>
@endsection