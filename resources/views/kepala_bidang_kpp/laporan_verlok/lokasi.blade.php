@extends(session('level').'.layout')
@section('title','SPRI - Laporan Verlok')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-transparent">
			<div class="card-header">
				<h4 class="card-title text-center">
					Lokasi Laporan Verlok
				</h4>
				<p class="card-category text-center">
					Nomor Surat Permohonan Verlok : <b>{{ $data->get_permohonan['nomor'] }} </b> | Nomor Surat Laporan Verlok : <b>{{ $data->nomor }} </b>
				</p>
			</div>
			<div class="card-body">
				<div class="col-md-10 ml-auto mr-auto">
					<div class="mapcontainer" style="box-shadow: 3px 3px 20px #dddfe0;border-radius: 10px;">
						<div id="map" class="vmap" style="height: 400px;border-radius: 10px;"></div>
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
		var myLatLng = {lat: {{ $data->lat }}, lng: {{ $data->lng }}};

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