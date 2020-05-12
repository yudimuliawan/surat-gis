@php
	use App\PermohonanVerlok;
@endphp
@extends(session('level').'.layout')
@section('title','SPRI - Wilayah')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Wilayah</h4>
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
				<a href="#">Wilayah</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">List Data</h4>
						{{-- <a class="btn btn-primary btn-round ml-auto" href="{{ Route('wilayah.create') }}">
							<i class="fa fa-plus"></i>
							Tambah Data
						</a> --}}
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="add-row" class="display table datatable table-striped table-hover" >
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Wilayah</th>
									<th>Warna</th>
									<th>Map</th>
									{{-- <th style="width: 10%">Action</th> --}}
								</tr>
							</thead>
							<tbody>
								@foreach ($list as $e)
								<tr>
									<td>{{ $loop->index + 1}}</td>
									<td>{{ $e->nama }}</td>
									<td><i class="fa fa-circle" style="color: {{ $e->warna }}"></i></td>
									<td>
										<a href="{{ url(session('level').'/wilayah/map/'.$e->id) }}" class="btn btn-sm btn-info" target="__blank">Lihat Map</a>
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