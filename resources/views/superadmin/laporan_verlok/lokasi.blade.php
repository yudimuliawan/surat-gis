@extends(session('level').'.layout')
@section('title','SPRI - Laporan Verlok')
@section('css')
<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
@endsection
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
						<div id="map" style="width: 100%; height: 400px;"></div>
						<div id="popup" class="ol-popup card">
							<a href="#" id="popup-closer" class="ol-popup-closer"></a>
							<div id="popup-content"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<script>
	var attribution = new ol.control.Attribution({
		collapsible: false
	});

	var pos = ol.proj.fromLonLat([{{ $data->lng }}, {{ $data->lat }}]);
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


	var layer = new ol.layer.Vector({
		source: new ol.source.Vector({
			features: [
			new ol.Feature({
				geometry: new ol.geom.Point(ol.proj.fromLonLat([{{ $data->lng }}, {{ $data->lat }}])),
				name : "Lorem Ipsum"
			})
			]
		})
	});
	map.addLayer(layer);

	var container = document.getElementById('popup');
	var content = document.getElementById('popup-content');
	var closer = document.getElementById('popup-closer');

	var overlay = new ol.Overlay({
		element: container,
		autoPan: true,
		autoPanAnimation: {
			duration: 250
		}
	});
	map.addOverlay(overlay);

	closer.onclick = function() {
		overlay.setPosition(undefined);
		closer.blur();
		return false;
	};

	map.on('singleclick', function (event) {
		if (map.hasFeatureAtPixel(event.pixel) === true) {
			var coordinate = event.coordinate;

			content.innerHTML = '<b>Titik Koordinat Surat No : {{ $data->nomor }}</b>';
			overlay.setPosition(coordinate);
		} else {
			overlay.setPosition(undefined);
			closer.blur();
		}
	});
</script>
@endsection