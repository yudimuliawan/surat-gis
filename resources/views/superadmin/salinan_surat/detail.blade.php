@extends(session('level').'.layout')
@section('title','SPRI - Salinan Surat')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Salinan Surat</h4>
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
				<a href="{{ url(session('level').'/salinan_surat') }}">Salinan Surat</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Detail</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Detail Data</h4>
						<span class="badge badge-info">{{ $salinanSurat->status }}</span>
					</div>
				</div>
				<div class="card-body">
					{{-- {{ $salinanSurat }} --}}
					<div class="row">
						<div class="col-sm-6">
							<strong>Nomor Surat</strong>
							<br>
							<p class="text-muted">{{ $salinanSurat->nomor }}</p>
							<strong>Tanggal Diterima</strong>
							<br>
							<p class="text-muted">{{ $salinanSurat->tanggal_diterima }}</p>
							<strong>Tanggal Surat</strong>
							<br>
							<p class="text-muted">{{ $salinanSurat->tanggal_surat }}</p>
							<strong>Tujuan Surat</strong>
							<br>
							<p class="text-muted">{{ $salinanSurat->tujuan }}</p>	
						</div>
						<div class="col-sm-6">
							<strong>Asal Surat</strong>
							<br>
							<p class="text-muted">{{ $salinanSurat->asal }}</p>
							<strong>Perihal Surat</strong>
							<br>
							<p class="text-muted">{{ $salinanSurat->perihal }}</p>
							<strong>Nama PT</strong>
							<br>
							<p class="text-muted">{{ $salinanSurat->nama_pt }}</p>
							<strong>Lampiran</strong>
							<br>
							<p class="text-muted">
								
								<a href="{{ asset('upload/lampiran/'.$salinanSurat->lampiran) }}" class="btn btn-sm btn-info" download="" target="__blank">Download Lampiran</a>

							</p>	
						</div>
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