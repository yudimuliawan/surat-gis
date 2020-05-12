@extends(session('level').'.layout')
@section('title','SPRI - Disposisi')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Disposisi</h4>
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
				<a href="{{ url(session('level').'/disposisi') }}">Disposisi</a>
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
			<form action="{{ Route('disposisi.store') }}" method="post" enctype="multipart/form-data">
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
									<select name="id_surat" class="form-control" id="id_surat" required="" onchange="get_surat()">
										<option>----</option>
										@foreach ($surat as $e)
										<option value="{{ $e->id }}">{{ $e->nomor }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default ">
									<label>Tanggal Disposisi</label>
									<input type="date" required="" name="tanggal_disposisi" class="form-control" placeholder="Masukan Tanggal Disposisi" value="{{ date('Y-m-d') }}">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Nomor Disposisi</label>
									<input type="text" required="" readonly="" name="nomor" class="form-control" placeholder="Masukan Nomor Disposisi" id="nomor">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Perihal Disposisi</label>
									<input type="text" required="" name="perihal" class="form-control" placeholder="Masukan Perihal Disposisi" id="perihal_surat">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Tujuan Disposisi</label>
									<select name="tujuan" class="form-control" required="" id="tujuan" onchange="get_kode()">
										<option>Kepala Seksi PRL</option>
										<option>Penerima Surat</option>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Jenis Instruksi</label>
									<input type="text" required="" name="jenis_instruksi" class="form-control" placeholder="Masukan Jenis Instruksi">
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a class="btn btn-danger btn-rounded" href="{{ url(session('level').'/disposisi') }}">Batal</a>
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

	function get_kode() {
		tujuan = $("#tujuan").val();
		tujuan = tujuan.charAt(0);

		$.ajax({
			type: 'GET', 
			url: '{{ url('api/get-kode-disposisi/') }}/'+tujuan,
			// dataType: 'json',
			success: function (data) {
				$("#nomor").val(data);
			},error:function(){ 
				console.log(data);
			}
		});
	}
	function get_surat() {
		id_surat = $("#id_surat").val();

		$.ajax({
			type: 'GET', 
			url: '{{ url('api/get-surat/') }}/'+id_surat,
			dataType: 'json',
			success: function (data) {
				$("#perihal_surat").val(data.perihal);
			},error:function(){ 
				console.log(data);
			}
		});
	}

	get_kode();
</script>
@endsection