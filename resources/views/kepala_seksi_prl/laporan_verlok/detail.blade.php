@extends(session('level').'.layout')
@section('title','SPRI - Laporan Verlok')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Laporan Verlok</h4>
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
				<a href="{{ url(session('level').'/laporan_verlok') }}">Laporan Verlok</a>
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
							<h4 class="text-secondary"><b>Data Permohon Verlok</b></h4>
						</div>
						<div class="col-sm-6">
							<strong>Nomor Surat Permohonan Verlok</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->get_permohonan['nomor'] }}</p>
							<strong>Tanggal Permohonan Verlok</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->get_permohonan['tanggal_verlok'] }}</p>
							<strong>Perihal</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->get_permohonan['perihal'] }}</p>
							<strong>Tujuan</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->get_permohonan['tujuan'] }}</p>
						</div>
						<div class="col-sm-6">
							<strong>Nama Pemohon</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->get_permohonan['nama_pemohon'] }}</p>	
							<strong>Lokasi</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->get_permohonan['lokasi'] }}</p>
							<strong>Jenis Kegiatan</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->get_permohonan['jenis_kegiatan'] }}</p>
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
							<p class="text-muted">{{ $laporanVerlok->nomor }}</p>
							<strong>Tanggal & Waktu Survey</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->tanggal_survey." - ".$laporanVerlok->waktu_survey }}</p>
							<strong>Perihal</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->perihal }}</p>
							<strong>Tujuan</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->tujuan }}</p>
						</div>
						<div class="col-sm-6">
							<strong>Hasil Verifikasi</strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->hasil_verifikasi }}</p>	
							<strong>Saran </strong>
							<br>
							<p class="text-muted">{{ $laporanVerlok->saran }}</p>
							<strong>Foto Kegiatan</strong>
							<br>
							<p class="text-muted">
								<img src="{{ asset('upload/laporan_verlok/'.$laporanVerlok->foto_kegiatan) }}" alt="" style="width: 100px; height: 100px; object-fit: contain">
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h4 class="text-secondary"><b>Map Koordinat Laporan Verlok</b></h4>
						</div>
						<div class="col-sm-12">
							<div class="mapcontainer" style="box-shadow: 3px 3px 20px #dddfe0;border-radius: 10px;">
								<div id="map" class="vmap" style="height: 400px;border-radius: 10px;"></div>
							</div>
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
		var myLatLng = {lat: {{ $laporanVerlok->lat }}, lng: {{ $laporanVerlok->lng }}};

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