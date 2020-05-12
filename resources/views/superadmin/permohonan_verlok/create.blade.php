@extends(session('level').'.layout')
@section('title','SPRI - Permohonan Verlok')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Permohonan Verlok</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="{{ url(session('level')) }}">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="{{ url(session('level').'/permohonan_verlok') }}">Permohonan Verlok</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Tambah Data</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="{{ Route('permohonan_verlok.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title">Masukan Data</h4>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group form-group-default ">
									<label>Nomor Surat</label>
									<select name="id_surat" class="form-control" required="" onchange="getSurat()" id="id_surat">
										<option>----</option>
										@foreach ($surat as $e)
										@if (count($e->get_disposisi) > 0 )
										<option value="{{ $e->id }}">{{ $e->nomor }}</option>
										@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default ">
									<label>Nomor Permohonan Verlok</label>
									<input type="text" required="" name="nomor" class="form-control" placeholder="Masukan Nomor Permohonan Verlok" readonly="" value="{{ $kode }}">
								</div>
							</div>

							{{-- <div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Perihal Surat</label>
									<input type="text" readonly="" required="" id="perihal_surat" class="form-control" >
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Tanggal Surat</label>
									<input type="text" readonly="" required="" id="tanggal_surat" class="form-control" >
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Nama PT</label>
									<input type="text" readonly="" required="" id="nama_pt" class="form-control" >
								</div>
							</div> --}}


							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Perihal Permohonan Verlok</label>
									<input type="text" required="" name="perihal" class="form-control" placeholder="Masukan Perihal Permohonan Verlok" id="perihal_surat">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Nama Pemohon</label>
									<input type="text" required="" name="nama_pemohon" class="form-control" placeholder="Masukan Nama Pemohon">
								</div>
							</div>


							
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Longitude</label>
									<input type="text" required="" name="lng" class="form-control" placeholder="Masukan Longitude">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Latitude</label>
									<input type="text" required="" name="lat" class="form-control" placeholder="Masukan Latitude">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Lokasi</label>
									<input type="text" required="" name="lokasi" class="form-control" placeholder="Masukan Lokasi">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Jenis Kegiatan</label>
									<input type="text" required="" name="jenis_kegiatan" class="form-control" placeholder="Masukan Jenis Kegiatan">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Tujuan Permohonan Verlok</label>
									<select name="tujuan" required="" class="form-control" id="">
										<option value="">----</option>
										<option>Cabang Dinas Situbondo</option>
										<option>Cabang Dinas Malang</option>
										<option>Cabang Dinas Blitar</option>
										<option>Cabang Dinas Tuban</option>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Tanggal Permohonan Verlok</label>
									<input type="date" required="" name="tanggal_verlok" class="form-control" placeholder="Masukan Tanggal Permohonan Verlok" value="{{ date('Y-m-d') }}">
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a class="btn btn-danger btn-rounded" href="{{ url(session('level').'/permohonan_verlok') }}">Batal</a>
						<button class="btn btn-rounded btn-success">Submit Data</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.datatable').DataTable({
		});

	});
	function confdel(id) {
		swal({
			title: 'Hapus data?',
			text: 'Semua data yang berhubungan dengan data ini akan ikut terhapus!',
			icon: 'warning',
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$("#form-"+id).submit();
			}
		});
	}

	function getSurat() {
		id_surat = $("#id_surat").val();

		$.ajax({
			type: 'GET', 
			url: '{{ url('api/get-surat/') }}/'+id_surat,
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$("#nama_pt").val(data.nama_pt);
				$("#tanggal_surat").val(data.tanggal_surat);
				$("#perihal_surat").val(data.perihal);
			},error:function(){ 
				console.log(data);
			}
		});
	}
</script>
@endsection