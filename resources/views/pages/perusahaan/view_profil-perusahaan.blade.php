@extends('layouts.dashboard')
@section('content')
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
	<!-- jquery validation -->
	   <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Profil Perusahaan</h5>
        <a href="{{url('ubah-perusahaan/'.$perusahaan->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit Data</a>
      </div>

			<div class="card card-outline card-info">
			  <!-- /.card-header -->
				<div class="card-body">
					<div class="row">
							<table id="example1" class="table table-hover">
	            <tr>
	              <td width="30%">Nama Perusahaan</td>
	              <td align="right" width="5%">:</td>
	              <th>{{$perusahaan->nama_perusahaan}}</th>
	            </tr>
	            <tr>
	            	<td width="30%">Alamat Perusahaan</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->alamat_perusahaan}}</th>
	            </tr>
	             <tr>
	            	<td width="30%">Jenis Usaha</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->jenis_usaha}}</th>
	            </tr>
	             <tr>
	            	<td width="30%">Nama Pemilik</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->nama_pemilik}}</th>
	            </tr>
	            <tr>
	            	<td width="30%">Bentuk Badan Usaha</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->bentuk_badan_usaha}}</th>
	            </tr>
	            <tr>
	            	<td width="30%">Jumlah Tenaga Kerja</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->jumlah_tenaga_kerja}}</th>
	            </tr>
	            <tr>
	            	<td width="30%">Nilai Investasi</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{formatRupiah($perusahaan->nilai_investasi)}}</th>
	            </tr>
	            <tr>
	            	<td width="30%">Kapasitas Produksi</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->kapasitas_produksi}}</th>
	            </tr>
	             <tr>
	            	<td width="30%">Bahan Baku</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->bahan_baku}}</th>
	            </tr>
	             <tr>
	            	<td width="30%">Bahan Penolong</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->bahan_penolong}}</th>
	            </tr>
	             <tr>
	            	<td width="30%">Peralatan</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->peralatan}}</th>
	            </tr>
	             <tr>
	            	<td width="30%">Cakupan Penjualan</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->cakupan_penjualan}}</th>
	            </tr>
	             <tr>
	            	<td width="30%">Surat Izin Usaha</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->surat_izin_usaha}} <a href="{{url('dokumen/perusahaan/'.$perusahaan->surat_izin_usaha)}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Download</a></th>
	            </tr>
	             <tr>
	            	<td width="30%">NPWP</td>
	            	<td align="right" width="5%">:</td>
	              <th>{{$perusahaan->npwp}} <a href="{{url('dokumen/perusahaan/'.$perusahaan->npwp)}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Download</a></th>
	            </tr>
	          </table>
					</div>
	        <!-- /.row -->
				</div>
			</div>
			<!--card-->
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

	function datakota(id_provinsi)
  {
	    //alert(id_provinsi);
	    var APP_URL = {!! json_encode(url('/')) !!};

	    if(id_provinsi!="")
	    {
	      $.ajax({
		        url: APP_URL+'/jsondatakota/'+id_provinsi,
		        type : 'GET',
		        datatype: "json",
		        success:function(data)
		        {
		        	//alert(output);
		          var output = JSON.parse(data);
		          //console.log(output);
		   
	            $('#kotaperusahaanSlc').empty();
	            $('#kotaperusahaanSlc').append('<option value="" selected="selected">-- Pilih Satu --</option>');
              $.each(output, function(key, value) {
                  $('#kotaperusahaanSlc').append('<option value="'+ key +'">'+ value +'</option>');
              });
		        } 
	      	});
	    }
	    else
	    {
	      	$('#kotaperusahaanSlc').empty();
	      	$('#kotaperusahaanSlc').append('<option value="" selected="selected">-- Pilih Parameter --</option>');
	    }
  }

  function datakotapabrik(id_provinsipabrik)
  {
	    //alert(id_provinsipabrik);
	    var APP_URL = {!! json_encode(url('/')) !!};

	    if(id_provinsipabrik!="")
	    {
	      $.ajax({
		        url: APP_URL+'/jsondatakota/'+id_provinsipabrik,
		        type : 'GET',
		        datatype: "json",
		        success:function(data)
		        {
		        	//alert(output);
		          var output = JSON.parse(data);
		          //console.log(output);
		   
	            $('#kotapabrikSlc').empty();
	            $('#kotapabrikSlc').append('<option value="" selected="selected">-- Pilih Satu --</option>');
              $.each(output, function(key, value) {
                  $('#kotapabrikSlc').append('<option value="'+ key +'">'+ value +'</option>');
              });
		        } 
	      	});
	    }
	    else
	    {
	      	$('#kotapabrikSlc').empty();
	      	$('#kotapabrikSlc').append('<option value="" selected="selected">-- Pilih Parameter --</option>');
	    }
  }
</script>
@endsection