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
				<a href="#">Disposisi</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">List Data</h4>
						{{-- <a class="btn btn-primary btn-round ml-auto" href="{{ Route('disposisi.create') }}">
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
									<th>Asal Surat</th>
									<th>Tanggal Disposisi</th>
									<th>Nomor Surat</th>
									<th>Nomor Disposisi</th>
									<th>Perihal</th>
									<th>Jenis Instruksi</th>
									<th style="width: 10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list as $e)
								<tr>
									<td>{{ $loop->index + 1}}</td>
									<td>{{ $e->get_surat['asal'] }}</td>
									<td>{{ $e->tanggal_disposisi }}</td>
									<td>{{ $e->get_surat['nomor'] }}</td>
									<td>{{ $e->nomor }}</td>
									<td>{{ $e->perihal }}</td>
									<td>{{ $e->jenis_instruksi }}</td>
									<td>
										<form action="{{ Route('disposisi.destroy',$e->id) }}" method="post" id="form-{{ $e->id }}">
											@csrf @method('delete')
											<div class="form-button-action">
												<input type="hidden" name="id" value="{{ $e->id }}">
												{{-- <a class="btn btn-sm btn-rounded btn-primary"  href="{{ Route('disposisi.edit',$e->id) }}">
													<i class="fa fa-edit"></i>
												</a>
												<button type="button" class="btn btn-sm btn-rounded btn-danger" onclick="confdel({{ $e->id }})">
													<i class="fa fa-times"></i>
												</button> --}}
												<a class="btn btn-sm btn-rounded btn-info"  href="{{ Route('disposisi.show',$e->id) }}">
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