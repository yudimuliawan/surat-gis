@extends(session('level').'.layout')
@section('title','SPRI - Laporan Verlok')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Laporan Verlok</h4>
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
				<a href="{{ url(session('level').'/laporan_verlok') }}">Laporan Verlok</a>
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
			<form action="{{ Route('laporan_verlok.store') }}" method="post" enctype="multipart/form-data">
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
									<label>Nomor Surat Permohonan Verlok</label>
									<select name="id_surat" class="form-control" required="" id="id_surat" onchange="get_permohonan()">
										<option>----</option>
										@foreach ($permohonan as $e)
										{{-- @if (count($e->get_disposisi) > 0 ) --}}
										<option value="{{ $e->id }}">{{ $e->nomor }}</option>
										{{-- @endif --}}
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Nomor Surat</label>
									<input type="text" required="" name="nomor" class="form-control" placeholder="Masukan Nomor Surat" readonly="" value="{{ $kode }}">
								</div>
							</div>
							<div class="col-sm-6">
								
								<div class="form-group form-group-default ">
									<label>Perihal</label>
									<input type="text" required="" name="perihal" class="form-control" placeholder="Masukan Perihal" id="perihal_surat">
								</div>
							</div>
							<div class="col-sm-6">
								
								<div class="form-group form-group-default ">
									<label>Tujuan</label>
									<input type="text" required="" name="tujuan" class="form-control" placeholder="Masukan Tujuan" id="tujuan">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Tanggal Survey</label>
									<input type="date" required="" name="tanggal_survey" class="form-control" placeholder="Masukan Tanggal Survey" value="{{ date('Y-m-d') }}">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Waktu Survey</label>
									<input type="text" required="" name="waktu_survey" class="form-control timepicker" placeholder="Masukan Waktu Survey">
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Longitude</label>
									<input type="text" required="" name="lng" class="form-control" placeholder="Masukan Longitude" id="lng">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Lattitude</label>
									<input type="text" required="" name="lat" class="form-control" placeholder="Masukan Lattitude" id="lat">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Foto Kegiatan</label>
									<input type="file" required="" name="foto_kegiatan" class="form-control" >
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Hasil Verifikasi</label>
									<textarea name="hasil_verifikasi" required="" class="form-control" placeholder ="Masukan Hasil Verifikasi"></textarea>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Saran</label>
									<textarea name="saran" required="" class="form-control" placeholder ="Masukan Saran"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a class="btn btn-danger btn-rounded" href="{{ url(session('level').'/laporan_verlok') }}">Batal</a>
						<button class="btn btn-rounded btn-success">Submit Data</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
@endsection
@section('js')
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
	$(document).ready(function() {
		$('.datatable').DataTable({
		});

		$('.timepicker').datetimepicker({
			format: 'LT'
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

	function get_permohonan() {
		id_surat = $("#id_surat").val();

		$.ajax({
			type: 'GET', 
			url: '{{ url('api/get-permohonan/') }}/'+id_surat,
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$("#perihal_surat").val(data.perihal);
				$("#tujuan").val(data.tujuan);
				$("#lng").val(data.lng);
				$("#lat").val(data.lat);
			},error:function(){ 
				console.log(data);
			}
		});
	}
</script>
@endsection