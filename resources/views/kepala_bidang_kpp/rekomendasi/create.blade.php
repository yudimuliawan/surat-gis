@extends(session('level').'.layout')
@section('title','SPRI - Rekomendasi ')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Rekomendasi </h4>
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
				<a href="{{ url(session('level').'/rekomendasi') }}">Rekomendasi </a>
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
			<form action="{{ Route('rekomendasi.store') }}" method="post" enctype="multipart/form-data">
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
									<select name="id_surat" class="form-control" required="" id="id_surat" onchange="getSurat()">
										<option hidden="">----</option>
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
									<label>Nomor Surat Laporan Verlok</label>
									<select name="id_laporan_verlok" class="form-control" required="" id="id_laporan_verlok" onchange="getLaporan()">
										<option>----</option>
										@foreach ($laporan_verlok as $e)
										<option value="{{ $e->id }}">{{ $e->nomor }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default ">
									<label>Nomor Surat Rekomendasi</label>
									<input type="text" required="" name="nomor" class="form-control" placeholder="Masukan Nomor Surat Rekomendasi" readonly="" value="{{ $kode }}">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default ">
									<label>Tanggal Surat Rekomendasi</label>
									<input type="date" required="" name="tanggal" class="form-control" placeholder="Masukan Tanggal Surat Rekomendasi" value="{{ date('Y-m-d') }}">
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Perihal</label>
									<input type="text" required="" name="perihal" class="form-control" placeholder="Masukan Perihal" id="perihal_surat">
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Tujuan Surat Rekomendasi</label>
									<input type="text" required="" name="tujuan" class="form-control" placeholder="Masukan Tujuan Surat Rekomendasi" id="tujuan">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Luas</label>
									<input type="text" required="" name="luas" class="form-control" placeholder="Masukan Luas">
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Longitude</label>
									<input type="text" required="" id="lng" readonly="" class="form-control" placeholder="Masukan Longitude">
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Lattitude</label>
									<input type="text" required="" id="lat" readonly="" class="form-control" placeholder="Masukan Lattitude">
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group form-group-default">
									<label>Lokasi</label>
									<input type="text" required="" id="lokasi" readonly="" class="form-control" placeholder="Masukan Lokasi">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Isi Surat</label>
									<textarea name="isi" class="form-control" required=""></textarea>
									{{-- <input type="text" required="" name="isi" class="form-control" placeholder="Masukan Isi Surat"> --}}
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a class="btn btn-danger btn-rounded" href="{{ url(session('level').'/rekomendasi') }}">Batal</a>
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

	function getLaporan() {
		id_laporan_verlok = $("#id_laporan_verlok").val();

		$.ajax({
			type: 'GET', 
			url: '{{ url('api/get-laporan-verlok/') }}/'+id_laporan_verlok,
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$("#lat").val(data.lat);
				$("#lng").val(data.lng);
				$("#lokasi").val(data.get_permohonan.lokasi);
			},error:function(){ 
				console.log(data);
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
				$("#tujuan").val(data.tujuan);
				$("#perihal_surat").val(data.perihal);
			},error:function(){ 
				console.log(data);
			}
		});
	}

</script>
@endsection