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
				<a href="{{ url(session('level').'/laporan_verlok') }}">Rekomendasi</a>
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
							<p class="text-muted">{{ $rekomendasi->get_surat['nomor'] }}</p>
							<strong>Tanggal Diterima</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_surat['tanggal_diterima'] }}</p>
							<strong>Tanggal Surat</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_surat['tanggal_surat'] }}</p>
							<strong>Tujuan Surat</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_surat['tujuan'] }}</p>	
						</div>
						<div class="col-sm-6">
							<strong>Asal Surat</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_surat['asal'] }}</p>
							<strong>Perihal Surat</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_surat['perihal'] }}</p>
							<strong>Nama PT</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_surat['nama_pt'] }}</p>
							<strong>Lampiran</strong>
							<br>
							<p class="text-muted">
								
								<a href="{{ asset('upload/lampiran/'.$rekomendasi->get_surat['lampiran']) }}" class="btn btn-sm btn-info" download="" target="__blank">Download Lampiran</a>

							</p>	
						</div>
					</div>
					<hr>
					<div class="row mb-4" >
						<div class="col-sm-12">
							<h4 class="text-secondary"><b>Data Laporan Verlok</b></h4>
						</div>
						<div class="col-sm-6">
							<strong>Nomor Surat Laporan Verlok</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_laporan['nomor'] }}</p>
							<strong>Tanggal & Waktu Survey</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_laporan['tanggal_survey']." - ".$rekomendasi->get_laporan['waktu_survey'] }}</p>
							<strong>Perihal</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_laporan['perihal'] }}</p>
							<strong>Tujuan</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_laporan['tujuan'] }}</p>
						</div>
						<div class="col-sm-6">
							<strong>Hasil Verifikasi</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_laporan['hasil_verifikasi'] }}</p>	
							<strong>Saran </strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->get_laporan['saran'] }}</p>
							<strong>Foto Kegiatan</strong>
							<br>
							<p class="text-muted">
								<img src="{{ asset('upload/laporan_verlok/'.$rekomendasi->get_laporan['foto_kegiatan']) }}" alt="" style="width: 100px; height: 100px; object-fit: contain">
							</p>
						</div>
					</div>
					<div class="row mb-4" >
						<div class="col-sm-12">
							<h4 class="text-secondary"><b>Data Rekomendasi</b></h4>
						</div>
						<div class="col-sm-6">
							<strong>Nomor Surat Rekomendasi</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->nomor }}</p>
							<strong>Perihal Surat</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->perihal }}</p>
							<strong>Tujuan Surat</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->tujuan }}</p>
						</div>
						<div class="col-sm-6">
							<strong>Isi Surat</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->isi }}</p>
							<strong>Luas</strong>
							<br>
							<p class="text-muted">{{ $rekomendasi->luas }}</p>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script async defer
src="https://maps.googleapis.com/maps/api/js?&callback=initMap">
</script>
<script>
	function initMap() {
		var myLatLng = {lat: {{ $rekomendasi->lat }}, lng: {{ $rekomendasi->lng }}};

		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 15,
			center: myLatLng
		});

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Hello World!'
		});
	}
</script>
@endsection