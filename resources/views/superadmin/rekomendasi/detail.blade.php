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
						<span class="badge badge-info">{{ $rekomendasi->get_surat['status'] }}</span>
					</div>
					<button onclick="printt()" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Print</button>
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
	<div class="penutup">
	</div>
	<div class="hide">
		<div class="col-sm-12">
			<div id="surat-container" style="padding: 20px; background-color: white;width: 100%;height: 100%;min-height: 400px;">
				<div style="height: 1540px;position: relative;">
					<table style="width: 100%;border-bottom: 3px solid black;">
						<tr>
							<td style="padding-bottom: 10px; text-align: center; width: 200px;">
								<img src="{{ asset('assets/img/profile.jpg') }}" alt="" style="width: 100px;height: 100px;">
							</td>
							<td style="padding-bottom: 10px; text-align: center;">
								<b style="margin-bottom: 0">PEMERINTAH PROVINSI JAWA TIMUR</b>
								<h3 style="letter-spacing: 5px;font-weight: 800;margin-bottom: 0;">DINAS KELAUTAN DAN PERIKANAN</h3>
								<p style="font-size: 13px;line-height: 14px; margin-bottom: 0">JL. Jend. A. Yani No. 152-B Telp.8291927, 8281672, 8288564,8288112,8292326 <br> Fax. 8288148, Tromol Pos 12/SBWO Wonocolo, e-mail : ikanjtm@indosat.net.id</p>
								<b style="font-weight: 800">SURABAYA 60235</b>
							</td>
						</tr>
					</table>
					<table style="width: 100%;font-size: 16px">
						<tr>
							<td colspan="2">
								<span style="float: right;margin-right: 30px;">Surabaya, {{ date('d F Y') }}</span>
							</td>
						</tr>
						<tr>  
							<td> 
								<table>
									<tr>
										<td>Nomor</td>
										<td>:</td>
										<td>{{ $rekomendasi->nomor }}</td>
									</tr>
									<tr>
										<td>Sifat</td>
										<td>:</td>
										<td>Penting</td>
									</tr>
									<tr>
										<td>Lampiran</td>
										<td>:</td>
										<td>1 (Satu) rangkap</td>
									</tr>
									<tr>
										<td>Perihal</td>
										<td>:</td>
										<td>{{ $rekomendasi->perihal }}</td>
									</tr>
								</table>
							</td>
							<td style="width: 200px;">
								<span>Kepada Yth.</span>
								<p>Sdr.Kepala {{ $rekomendasi->tujuan }} di tempat</p>
							</td>
						</tr>
					</table>
					<div style="padding: 30px;">
						<p style="text-indent: 40px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed nam veniam obcaecati optio non quia eos quae, ipsum dolor, labore, suscipit veritatis! Doloremque, excepturi dolorem deleniti mollitia pariatur corporis aliquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed nam veniam obcaecati optio non quia eos quae, ipsum dolor, labore, suscipit veritatis! Doloremque, excepturi dolorem deleniti mollitia pariatur corporis aliquam.</p>
						<p style="text-indent: 40px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed nam veniam obcaecati optio non quia eos quae, ipsum dolor, labore, suscipit veritatis! Doloremque, excepturi dolorem deleniti mollitia pariatur corporis aliquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed nam veniam obcaecati optio non quia eos quae, ipsum dolor, labore, suscipit veritatis! Doloremque, excepturi dolorem deleniti mollitia pariatur corporis aliquam.</p>
					</div>
					<div style="width: 400px;text-align: center;position: absolute; bottom: 2%; right: 0">
						<span>
							<b>a.n. KEPALA DINAS KELAUTAN DAN PERIKANAN</b>
							<br>
							<b>PROVINSI JAWA TIMUR</b>
							<br>
							<b>KEPALA BIDANG KELAUTAN, PESISIR DAN <br> PENGAWASAN</b>
						</span>
						<br><br><br><br><br><br>
						<span style="">
							<b><u>Ir. SLAMET BUDIYONO, MM</u></b><br>
							Pembina Tingkat I <br>
							Nip. 19620217 198503 1 002
						</span>
					</div>
				</div>
				<div style="height: 1540px;position: relative;">
					<div style="width: 100%;text-align: center;text-transform: uppercase;font-size: 20px;">
						<b>lokasi <br> {{ $rekomendasi->get_surat['nama_pt'] }}</b>
						<br>
					</div>
					<table style="width: 100%;font-size: 18px!important;font-weight: 500!important" class="table-bordered">
						<tr>
							<td style="width: 20px;">No</td>
							<td>Informasi</td>
							<td>Keterangan</td>
						</tr>
						<tr>
							<td style="width: 20px;">1</td>
							<td>Titik Koordinat</td>
							<td>{{ $rekomendasi->get_laporan['lng'].' , '.$rekomendasi->get_laporan['lat'] }}</td>
						</tr>
						<tr>
							<td style="width: 20px;">2</td>
							<td>Luas</td>
							<td>{{ $rekomendasi->luas }}</td>
						</tr>
						<tr>
							<td style="width: 20px;">3</td>
							<td>Lokasi</td>
							<td>{{ PermohonanVerlok::find($rekomendasi->get_laporan['id_permohonan_verlok'])->lokasi }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div id="divhidden"></div>
		</div>
	</div>
</div>

@endsection
@section('css')
<style>
	td{
		padding: 5px!important;
	}
	@media print {
		.header, .hide { visibility: hidden }
	}
	body{
		overflow-x: hidden;
	}
	.hide{
		position: absolute;
		/*left: -100%;*/
		margin-top: 400px;
		z-index: -99;
	}
	.penutup{
		width: 100%;
		background-color: #f9fbfd;
		height: 8000px;
		position: absolute;
		z-index: 99;
	}
</style>
@endsection
@section('js')
<script async defer
src="https://maps.googleapis.com/maps/api/js?&callback=initMap">
</script>
<script src="{{ asset('dist/jspdf.min.js') }}"></script>
<script>
	function initMap() {
		var myLatLng = {lat: {{ $rekomendasi->get_laporan['lat'] }}, lng: {{ $rekomendasi->get_laporan['lng'] }}};

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

	generate();
	function generate() {
		html2canvas($("#surat-container"), {
			onrendered: function(canvas) {
				var canvasImg = canvas.toDataURL("image/jpg");
				$('#divhidden').html('<img src="'+canvasImg+'" alt="">');
			}
		});
	}

	function printt() {
		var printContent = document.getElementById("divhidden");
		var printWindow = window.open("", "","left=50,top=50");                
		printWindow.document.write(printContent.innerHTML);
		printWindow.document.write("<script src=\'http://code.jquery.com/jquery-1.10.1.min.js\'><\/script>");
		printWindow.document.write("<script>$(window).load(function(){ print(); close(); });<\/script>");
		printWindow.document.close();  
	}

</script>
@endsection