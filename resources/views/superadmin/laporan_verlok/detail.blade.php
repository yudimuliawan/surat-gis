@php
use App\SalinanSurat;
@endphp
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
						<span class="badge badge-info">{{ salinanSurat::find($laporanVerlok->get_permohonan['id_surat'])->status }}</span>
					</div>
					<button onclick="printt()" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Print</button>
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
										<td>{{ $laporanVerlok->get_permohonan['nomor'] }}</td>
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
										<td>{{ $laporanVerlok->get_permohonan['perihal'] }}</td>
									</tr>
								</table>
							</td>
							<td style="width: 200px;">
								<span>Kepada Yth.</span>
								<p>Sdr.Kepala {{ $laporanVerlok->get_permohonan['tujuan'] }} di tempat</p>
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
						<b>LEMBAR VERIFIKASI <br> cabang dinas kelautan dan perikanan <br> provinsi jawa timur</b>
						<br>
						<br>
						<b>Data permohonan (diisi oleh bidang kpp)</b>
					</div>
					<table style="width: 100%;font-size: 18px!important;font-weight: 500!important" class="table-bordered">
						<tr>
							<td style="width: 300px;">Nama Pemohon</td>
							<td style="text-align: center;width:20px;">:</td>
							<td style="padding-left: 5px;">{{ $laporanVerlok->get_permohonan['nama_pemohon'] }}</td>
						</tr>
						<tr>
							<td style="width: 300px;">Lokasi</td>
							<td style="text-align: center;width:20px;">:</td>
							<td style="padding-left: 5px;">{{ $laporanVerlok->get_permohonan['lokasi'] }}</td>
						</tr>
						<tr>
							<td style="width: 300px;">Titik Koordinat</td>
							<td style="text-align: center;width:20px;">:</td>
							<td style="padding-left: 5px;">{{ $laporanVerlok->get_permohonan['lng'].' , '.$laporanVerlok->get_permohonan['lat'] }}</td>
						</tr>
						<tr>
							<td style="width: 300px;">Jenis Kegiatan</td>
							<td style="text-align: center;width:20px;">:</td>
							<td style="padding-left: 5px;">{{ $laporanVerlok->get_permohonan['jenis_kegiatan'] }}</td>
						</tr>
					</table>
					<br>
					<center>
						<b style="font-size: 20px;text-transform: uppercase;text-align: center;">hasil verifikasi/survey lapangan (diisi oleh cabang dinas)</b>
					</center>
					<br>
					<table style="width: 100%;font-size: 18px!important;font-weight: 500!important" class="table-bordered">
						<tr>
							<td style="width: 300px;">Nama PT/CV/Kelompok/Koperasi</td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>{{ SalinanSurat::find($laporanVerlok->get_permohonan['id_surat'])->nama_pt }}</td>
						</tr>
						<tr>
							<td style="width: 300px;">Tanggal</td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>{{ $laporanVerlok->tanggal_survey }}</td>
						</tr>
						<tr>
							<td style="width: 300px;">Waktu </td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>{{ $laporanVerlok->waktu_survey }}</td>
						</tr>
						<tr>
							<td style="width: 300px;">Lokasi</td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>{{ $laporanVerlok->get_permohonan['lokasi'] }}</td>
						</tr>
						<tr>
							<td style="width: 300px;">Titik Koordinat</td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>{{ $laporanVerlok->get_permohonan['lng'].' , '.$laporanVerlok->get_permohonan['lat'] }}</td>
						</tr>
						<tr style="height: 200px;vertical-align: baseline!important;">
							<td style="width: 300px;">Hasil Verifikasi/Survey <br> (Kondisi Eksisting)</td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>{{ $laporanVerlok->hasil_verifikasi }}</td>
						</tr>
						<tr style="height: 200px;vertical-align: baseline!important;">
							<td style="width: 300px;">Foto Kegiatan</td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>
								<img src="{{ asset('upload/laporan_verlok/'.$laporanVerlok->foto_kegiatan) }}" alt="" style="width: 200px; height: 200px; object-fit: contain">
							</td>
						</tr>
						<tr style="height: 200px;vertical-align: baseline!important;">
							<td style="width: 300px;">Saran dan Masukan</td>
							<td style="text-align: center;width: 20px;">:</td>
							<td>{{ $laporanVerlok->saran }}</td>
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