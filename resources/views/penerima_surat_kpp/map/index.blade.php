@extends(session('level').'.layout')
@section('title','SPRI - Koordinat')
@section('css')
<style>
	.hide{
		display: none;
	}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-transparent">
			<div class="card-header">
				<h4 class="card-title text-center">Koordinat Map</h4>
				<p class="card-category text-center">Cari lokasi dan dapatkan koordinatnya.</p>
			</div>
			<div class="card-body">
				<div class="col-md-10 ml-auto mr-auto">
					<center>
						Latitude: <b id="lat">----</b> 

						Longitude: <b id="lng">----</b> <br/>

						<b id="txt" class="hide">Sedang encari titik...</b>
					</center>
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
		

		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 10,
			center: new google.maps.LatLng(-6.2293867,106.6894293),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var myMarker = new google.maps.Marker({
			position: new google.maps.LatLng(-6.2293867,106.6894293),
			draggable: true
		});

		google.maps.event.addListener(myMarker, 'dragend', function (evt) {
			$("#lat").html(evt.latLng.lat().toFixed(3));
			$("#lng").html(evt.latLng.lng().toFixed(3));
			$("#txt").addClass('hide');
		// document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
	});

		google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
		// document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
		$("#txt").removeClass('hide');
	});

		map.setCenter(myMarker.position);
		myMarker.setMap(map);
	}

</script>
@endsection