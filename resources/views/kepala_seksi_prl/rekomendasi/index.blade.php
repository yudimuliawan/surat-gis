@php
	use App\PermohonanVerlok;
@endphp
@extends(session('level').'.layout')
@section('title','SPRI - Rekomendasi')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Rekomendasi</h4>
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
				<a href="#">Rekomendasi</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">List Data</h4>
						{{-- <a class="btn btn-primary btn-round ml-auto" href="{{ Route('rekomendasi.create') }}">
							<i class="fa fa-plus"></i>
							Tambah Data
						</a> --}}
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="add-row" class="display table table-print table-striped table-hover" >
							<thead>
								<tr>
									<th>#</th>
									<th>Tanggal</th>
									<th>Tujuan Surat</th>
									<th>Lokasi</th>
									<th>Nama PT</th>
									{{-- <th>Perihal</th>
									<th>Nama PT</th>
									<th>Lokasi</th> --}}
									<th style="width: 10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list as $e)
								<tr>
									<td>{{ $loop->index + 1}}</td>
									<td>{{ $e->get_surat['tanggal_surat'] }}</td>
									<td>{{ $e->tujuan }}</td>
									<td>{{ PermohonanVerlok::find($e->get_laporan['id_permohonan_verlok'])->lokasi	}}</td>
									<td>{{ $e->get_surat['nama_pt'] }}</td>
									{{-- <td>{{ $e->get_surat['perihal'] }}</td>
									<td>{{ $e->get_surat['nama_pt'] }}</td>
									<td>{{ $e->lokasi }}</td>
									 --}}{{-- <td>{{ $e->nomor }}</td>
									<td>{{ $e->perihal }}</td>
									<td>{{ $e->nama_pt }}</td>
									<td>
										<a href="{{ asset('upload/lampiran/'.$e->lampiran) }}" class="btn btn-sm btn-info" download="" target="__blank">Download Lampiran</a>
									</td> --}}
									<td>
										<form action="{{ Route('rekomendasi.destroy',$e->id) }}" method="post" id="form-{{ $e->id }}">
											@csrf @method('delete')
											<div class="form-button-action">
												<input type="hidden" name="id" value="{{ $e->id }}">
												{{-- <a class="btn btn-sm btn-rounded btn-primary"  href="{{ Route('rekomendasi.edit',$e->id) }}">
													<i class="fa fa-edit"></i>
												</a>
												<button type="button" class="btn btn-sm btn-rounded btn-danger" onclick="confdel({{ $e->id }})">
													<i class="fa fa-times"></i>
												</button> --}}
												{{-- <a class="btn btn-sm btn-rounded btn-primary"  href="{{ url(session('level').'/rekomendasi/lokasi/'.$e->id) }}">
													<i class="fa fa-map-marker-alt"></i>
												</a> --}}
												<a class="btn btn-sm btn-rounded btn-info"  href="{{ Route('rekomendasi.show',$e->id) }}">
													<i class="fa fa-search"></i>
												</a>
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
{{-- <script src="{{ asset('data-table/datatable.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('data-table/datatableButton.js') }}" type="text/javascript"></script>
<script src="{{ asset('data-table/flash.js') }}" type="text/javascript"></script>
<script src="{{ asset('data-table/html5.js') }}" type="text/javascript"></script>
<script src="{{ asset('data-table/jzip.js') }}" type="text/javascript"></script>
<script src="{{ asset('data-table/pdf.js') }}" type="text/javascript"></script>
<script src="{{ asset('data-table/print.js') }}" type="text/javascript"></script>
<script src="{{ asset('data-table/vfs.js') }}" type="text/javascript"></script>
<script src="{{ asset('data-table/select2.js') }}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.datatable').DataTable();
		$('.table-print').DataTable({
			dom: 'Bfrtip',
			buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
		$(".buttons-html5").addClass('btn btn-primary btn-sm');
		$(".buttons-print").addClass('btn btn-primary btn-sm');
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