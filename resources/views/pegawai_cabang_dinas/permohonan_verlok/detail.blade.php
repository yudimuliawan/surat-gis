@extends(session('level').'.layout')
@section('title','SPRI - Permohonan Verlok')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Permohonan Verlok</h4>
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
				<a href="{{ url(session('level').'/permohonan_verlok') }}">Permohonan Verlok</a>
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
							<p class="text-muted">{{ $permohonanVerlok->get_surat['nomor'] }}</p>
							<strong>Tanggal Diterima</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->get_surat['tanggal_diterima'] }}</p>
							<strong>Tanggal Surat</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->get_surat['tanggal_surat'] }}</p>
							<strong>Tujuan Surat</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->get_surat['tujuan'] }}</p>	
						</div>
						<div class="col-sm-6">
							<strong>Asal Surat</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->get_surat['asal'] }}</p>
							<strong>Perihal Surat</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->get_surat['perihal'] }}</p>
							<strong>Nama PT</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->get_surat['nama_pt'] }}</p>
							<strong>Lampiran</strong>
							<br>
							<p class="text-muted">
								
								<a href="{{ asset('upload/lampiran/'.$permohonanVerlok->get_surat['lampiran']) }}" class="btn btn-sm btn-info" download="" target="__blank">Download Lampiran</a>

							</p>	
						</div>
					</div>
					<hr>
					<div class="row mb-4" >
						<div class="col-sm-12">
							<h4 class="text-secondary"><b>Data Permohonan Verlok</b></h4>
						</div>
						<div class="col-sm-6">
							<strong>Nomor Surat Permohonan Verlok</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->nomor }}</p>
							<strong>Tanggal Permohonan Verlok</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->tanggal_verlok }}</p>
							<strong>Perihal</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->perihal }}</p>
							<strong>Tujuan</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->tujuan }}</p>
						</div>
						<div class="col-sm-6">
							<strong>Nama Pemohon</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->nama_pemohon }}</p>	
							<strong>Lokasi</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->lokasi }}</p>
							<strong>Jenis Kegiatan</strong>
							<br>
							<p class="text-muted">{{ $permohonanVerlok->jenis_kegiatan }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h4 class="text-secondary"><b>Map Koordinat Permohonan Verlok</b></h4>
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
		var myLatLng = {lat: {{ $permohonanVerlok->lat }}, lng: {{ $permohonanVerlok->lng }}};

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