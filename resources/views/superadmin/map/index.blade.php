@extends(session('level').'.layout')
@section('title','SPRI - Koordinat')
@section('css')
<style>
	.hide{
		display: none;
	}

	/*html, body, #map { width:100%; height:100%; margin:0; }*/
	#map {
		/*position: absolute;*/
		z-index: 5;
	}
	#msg{
		position: absolute;
		z-index: 10;
		left: 50%;
		transform: translate(-50%, 5px);
		background-color: rgba(40,40,40,.8);
		padding: 10px;
		color: #eee;
		width: 350px;
		text-align: center;
	}
	#marker {
		width: 20px;
		height: 20px;
		border: 1px solid #088;
		border-radius: 10px;
		background-color: #0FF;
		opacity: 0.5;
		cursor: move;
	}
	.ol-overlaycontainer-stopevent{
		display: none!important;
	}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.17.1/ol.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.17.1/ol.js"></script>

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
						{{-- Latitude: <b id="lat">----</b> 

						Longitude: <b id="lng">----</b> <br/> --}}

						<b id="txt" class="hide">Sedang encari titik...</b>
						<b id="coords" class="">Latitude: - Longitude: -</b>
					</center>
					<div class="mapcontainer" style="box-shadow: 3px 3px 20px #dddfe0;border-radius: 10px;">
						<div id="map" style="width: 100%" class="map"></div>
						{{-- <div id="msg">Dragging ol.Overlay</div> --}}
						{{-- <div id="marker" title="Marker"></div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	// position: new google.maps.LatLng(-6.2293867,106.6894293),
	var pos = ol.proj.fromLonLat([106.6894293, -6.2293867]);
	var layer = new ol.layer.Tile({
		source: new ol.source.OSM()
	});
	var map = new ol.Map({
		layers: [layer],
		target: 'map',
		view: new ol.View({
			center: pos,
			zoom: 15
		})
	});
	// var marker_el = document.getElementById('marker');
	// var marker = new ol.Overlay({
	// 	position: pos,
	// 	positioning: 'center-center',
	// 	element: marker_el,
	// 	stopEvent: false,
	// 	dragging: false
	// });
	// map.addOverlay(marker);

	var dragPan;
	map.getInteractions().forEach(function(interaction){
		if (interaction instanceof ol.interaction.DragPan) {
			dragPan = interaction;  
		}
	});

	// marker_el.addEventListener('mousedown', function(evt) {
	// 	dragPan.setActive(false);
	// 	marker.set('dragging', true);
	// 	$("#txt").removeClass('hide');
	// 	console.info('start dragging');
	// });

	// map.on('pointermove', function(evt) {
	// 	if (marker.get('dragging') === true) {
	// 		marker.setPosition(evt.coordinate);
	// 	}
	// });

	// map.on('pointerup', function(evt) {
	// 	if (marker.get('dragging') === true) {
	// 		console.info(evt);
	// 		$("#lat").html(evt.coordinate[0]);
	// 		$("#lng").html(evt.coordinate[1]);
	// 		$("#txt").addClass('hide');
	// 		dragPan.setActive(true);
	// 		marker.set('dragging', false);
	// 	}
	// });
	map.on('click', function(evt){
    console.info(evt.pixel);
    console.info(map.getPixelFromCoordinate(evt.coordinate));
    console.info(ol.proj.toLonLat(evt.coordinate));
    var coords = ol.proj.toLonLat(evt.coordinate);
    var lat = coords[1];
    var lon = coords[0];
    var locTxt = "Latitude: " + lat + " Longitude: " + lon;
    // coords is a div in HTML below the map to display
    document.getElementById('coords').innerHTML = locTxt;
});
</script>
@endsection