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
				<a href="#">Permohonan Rekomendasi</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">List Data</h4>
						<a class="btn btn-primary btn-round ml-auto" href="{{ Route('permohonan_rekomendasi.create') }}">
							<i class="fa fa-plus"></i>
							Tambah Data
						</a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="add-row" class="display table datatable table-striped table-hover" >
							<thead>
								<tr>
									<th>#</th>
									<th>No Surat</th>
									<th>Tujuan</th>
									<th>Asal</th>
									<th>Perihal</th>
									<th>Nama PT</th>
									<th>Penanggung Jawab</th>
									<th>Lokasi</th>
									<th>Lampiran</th>
									<th style="width: 10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list as $e)
								<tr>
									<td>{{ $loop->index + 1}}</td>
									<td>{{ $e->nomor }}</td>
									<td>{{ $e->tujuan }}</td>
									<td>{{ $e->asal }}</td>
									<td>{{ $e->perihal }}</td>
									<td>{{ $e->nama_pt }}</td>
									<td>{{ $e->pj }}</td>
									<td>{{ $e->lokasi }}</td>
									<td>
										<a href="{{ asset('upload/lampiran/'.$e->lampiran) }}" class="btn btn-sm btn-info" download="" target="__blank">Download Lampiran</a>
									</td>
									<td>
										<form action="{{ Route('permohonan_rekomendasi.destroy',$e->id) }}" method="post" id="form-{{ $e->id }}">
											@csrf @method('delete')
											<div class="form-button-action">
												<input type="hidden" name="id" value="{{ $e->id }}">
												<a class="btn btn-sm btn-rounded btn-primary"  href="{{ Route('permohonan_rekomendasi.edit',$e->id) }}">
													<i class="fa fa-edit"></i>
												</a>
												<button type="button" class="btn btn-sm btn-rounded btn-danger" onclick="confdel({{ $e->id }})">
													<i class="fa fa-times"></i>
												</button>
											</div>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
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