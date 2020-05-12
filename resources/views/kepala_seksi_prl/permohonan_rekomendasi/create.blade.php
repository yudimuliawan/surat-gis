@extends(session('level').'.layout')
@section('title','SPRI - Permohonan Rekomendasi')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Permohonan Rekomendasi</h4>
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
				<a href="{{ url(session('level').'/permohonan_rekomendasi') }}">Permohonan Rekomendasi</a>
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
			<form action="{{ Route('permohonan_rekomendasi.store') }}" method="post" enctype="multipart/form-data">
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
									<label>Tujuan Surat</label>
									<input type="text" required="" name="tujuan" class="form-control" placeholder="Masukan Tujuan">
								</div>
							</div>
							<div class="col-sm-6">
								
								<div class="form-group form-group-default ">
									<label>Asal Surat</label>
									<input type="text" required="" name="asal" class="form-control" placeholder="Masukan Asal Surat">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Nomor Surat</label>
									<input type="text" required="" name="nomor" class="form-control" placeholder="Masukan Nomor Surat">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Perihal</label>
									<input type="text" required="" name="perihal" class="form-control" placeholder="Masukan Perihal">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Nama PT</label>
									<input type="text" required="" name="nama_pt" class="form-control" placeholder="Masukan Nama PT">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Penanggung Jawab</label>
									<input type="text" required="" name="pj" class="form-control" placeholder="Masukan Penanggung Jawab">
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
									<label>Lampiran</label>
									<input type="file" required="" name="lampiran" class="form-control" >
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a class="btn btn-danger btn-rounded" href="{{ url(session('level').'/permohonan_rekomendasi') }}">Batal</a>
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
</script>
@endsection