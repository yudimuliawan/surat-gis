@extends(session('level').'.layout')
@section('title','SPRI - Wilayah')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-transparent">
			<div class="card-header">
				<h4 class="card-title text-center">
					Map Wilayah
				</h4>
				<p class="card-category text-center">
					Tampilan map wilayah {{ $wilayah->nama }}
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
<script async defer src="https://maps.googleapis.com/maps/api/js?sensor=false"> </script>
<script src="{{ asset('assets/js/GMap.js') }}"></script>
@endsection
@section('js')
<script>
	$(document).ready(function(){
		@php
		$path = json_decode($wilayah->lnglat,false);
		// $path = array_reverse($path);
		@endphp
		map = new GMaps({
			el: '#map',
			lat: {{ $path[0][1] }},
			lng: {{ $path[0][0] }},
			zoom : 15,
			click: function(e){
				console.log(e);
			}
		});


		path = [@foreach ($path as $e)[<?php echo $e[1] ?>,<?php echo $e[0] ?>]{{ $loop->index == count($path) - 1 ? '' : ',' }}@endforeach];

		// path = [[-12.040397656836609,-77.03373871559225], [-12.040248585302038,-77.03993927003302], [-12.050047116528843,-77.02448169303511], [-12.044804866577001,-77.02154422636042]];

		map.drawPolygon({
			paths: path,
			strokeColor: '{{ $wilayah->warna }}',
			fillColor: '{{ $wilayah->warna }}',
			strokeOpacity: 0.6,
			strokeWeight: 6
		});
	});
</script>
@endsection