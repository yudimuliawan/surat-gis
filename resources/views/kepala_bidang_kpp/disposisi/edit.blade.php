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
				<a href="#">Edit Data</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="{{ Route('disposisi.update',$data->id) }}" method="post" enctype="multipart/form-data">
				@csrf @method('patch')
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
									<select name="id_surat" class="form-control" required="" id="id_surat" onchange="get_surat()">
										<option>----</option>
										@foreach ($surat as $e)
										<option {{ $e->id == $data->id_surat ? 'selected' : '' }} value="{{ $e->id }}">{{ $e->nomor }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default ">
									<label>Tanggal Disposisi</label>
									<input type="date" required="" name="tanggal_disposisi" value="{{ $data->tanggal_disposisi }}" class="form-control" placeholder="Masukan Tanggal Disposisi">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Nomor Disposisi</label>
									<input type="text" readonly="" required="" name="nomor" value="{{ $data->nomor }}" class="form-control" placeholder="Masukan Nomor Disposisi" id="nomor">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Perihal Disposisi</label>
									<input type="text" required="" name="perihal" value="{{ $data->perihal }}" class="form-control" placeholder="Masukan Perihal Disposisi" id="perihal_surat">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Tujuan Disposisi</label>
									{{-- <input type="text" required="" name="tujuan" class="form-control" placeholder="Masukan Tujuan Disposisi"> --}}
									<select name="tujuan" class="form-control" required="" onchange="get_kode()" id="tujuan">
										<option {{ $data->tujuan=="Kepala Seksi PRL" ? 'selected' : '' }}>Kepala Seksi PRL</option>
										<option {{ $data->tujuan=="Penerima Surat" ? 'selected' : '' }}>Penerima Surat</option>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Jenis Instruksi</label>
									<input type="text" required="" name="jenis_instruksi" value="{{ $data->jenis_instruksi }}" class="form-control" placeholder="Masukan Jenis Instruksi">
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
	function get_kode() {
		kode = $("#nomor").val();
		tujuan =$("#tujuan").val().charAt(0);
		if (tujuan=="K") {
			kode = kode.replace('.2','.3');
		}else{
			kode = kode.replace('.3','.2');
		}
		$("#nomor").val(kode);
	}
</script>
@endsection