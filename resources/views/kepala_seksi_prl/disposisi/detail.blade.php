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
					</div>
				</div>
				<div class="card-body">
					<div class="row mb-4" >
						<div class="col-sm-12">
							<h4 class="text-secondary"><b>Data Salinan Surat</b></h4>
						</div>
						<div class="col-sm-6">
							<strong>Nomor Surat</strong>
							<br>
							<p class="text-muted">{{ $disposisi->get_surat['nomor'] }}</p>
							<strong>Tanggal Diterima</strong>
							<br>
							<p class="text-muted">{{ $disposisi->get_surat['tanggal_diterima'] }}</p>
							<strong>Tanggal Surat</strong>
							<br>
							<p class="text-muted">{{ $disposisi->get_surat['tanggal_surat'] }}</p>
							<strong>Tujuan Surat</strong>
							<br>
							<p class="text-muted">{{ $disposisi->get_surat['tujuan'] }}</p>	
						</div>
						<div class="col-sm-6">
							<strong>Asal Surat</strong>
							<br>
							<p class="text-muted">{{ $disposisi->get_surat['asal'] }}</p>
							<strong>Perihal Surat</strong>
							<br>
							<p class="text-muted">{{ $disposisi->get_surat['perihal'] }}</p>
							<strong>Nama PT</strong>
							<br>
							<p class="text-muted">{{ $disposisi->get_surat['nama_pt'] }}</p>
							<strong>Lampiran</strong>
							<br>
							<p class="text-muted">
								
								<a href="{{ asset('upload/lampiran/'.$disposisi->get_surat['lampiran']) }}" class="btn btn-sm btn-info" download="" target="__blank">Download Lampiran</a>

							</p>	
						</div>
					</div>
					<hr>
					<div class="row mb-4" >
						<div class="col-sm-12">
							<h4 class="text-secondary"><b>Data Disposisi</b></h4>
						</div>
						<div class="col-sm-6">
							<strong>Nomor Surat Disposisi</strong>
							<br>
							<p class="text-muted">{{ $disposisi->nomor }}</p>
							<strong>Tanggal Disposisi</strong>
							<br>
							<p class="text-muted">{{ $disposisi->tanggal_disposisi }}</p>
							<strong>Perihal</strong>
							<br>
							<p class="text-muted">{{ $disposisi->perihal }}</p>
						</div>
						<div class="col-sm-6">
							<strong>Tujuan Disposisi</strong>
							<br>
							<p class="text-muted">{{ $disposisi->tujuan }}</p>	
							<strong>Jenis Instruksi</strong>
							<br>
							<p class="text-muted">{{ $disposisi->jenis_instruksi }}</p>
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