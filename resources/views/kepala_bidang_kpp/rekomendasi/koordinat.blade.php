@extends(session('level').'.layout')
@section('title','SPRI - Wilayah')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-transparent">
			<div class="card-header text-center">
				<h4 class="card-title text-center">Data Koordinat</h4>
				<p class="card-category text-center">
					Tampilan koordinat berdasar data rekomendasi
				</p>
				@foreach ($wilayah as $e)
					<span><i class="fa fa-circle" style="color: {{ $e->warna }}"></i> {{ $e->nama }}</span>
				@endforeach
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
		@if(count($wilayah) > 0 )
		@php
		$path = json_decode($wilayah[0]->lnglat,false);
		// $path = array_reverse($path);
		@endphp
		map = new GMaps({
			el: '#map',
			lat: {{ $path[0][1] }},
			lng: {{ $path[0][0] }},
			zoomIn : 15,
			click: function(e){
				console.log(e);
			}
		});

		@foreach ($wilayah as $e)
		@php
		$path = json_decode($e->lnglat,false);
		@endphp
		path = [@foreach ($path as $k)[<?php echo $k[1] ?>,<?php echo $k[0] ?>]{{ $loop->index == count($path) - 1 ? '' : ',' }}@endforeach];

		map.drawPolygon({
			paths: path,
			strokeColor: '{{ $e->warna }}',
			fillColor: '{{ $e->warna }}',
			strokeOpacity: 0.6,
			strokeWeight: 6
		});
		@endforeach
		@foreach ($list as $e)
		map.addMarker({
			lat: {{ $e->get_laporan['lat'] }},
			lng: {{ $e->get_laporan['lng'] }},
			// title: "title",
			infoWindow: {
				content:'{{ $e->nomor }}'
			}
		});
		@endforeach
		@endif
	});
</script>
@endsection