@extends(session('level').'.layout')
@section('title','SPRI - Wilayah')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Wilayah</h4>
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
				<a href="{{ url(session('level').'/wilayah') }}">Wilayah</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Tambah Data</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="{{ Route('wilayah.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title">Masukan Data</h4>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Nama Wilayah</label>
									<input type="text" required="" name="nama" class="form-control" placeholder="Masukan Wilayah">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default">
									<label>Warna</label>
									<input type="text" required="" name="warna" class="form-control colorpicker" placeholder="Masukan Warna">
								</div>
							</div>
							<div class="col-sm-12">	
								<ul class="nav nav-pills nav-primary">
									<li class="nav-item">
										<a onclick="add()" class="nav-link text-white bg-primary" href="#"><i class="fa fa-plus"></i></a>
									</li>
									<li class="nav-item">
										<a onclick="del()" class="nav-link text-white bg-danger" href="#"><i class="fa fa-minus"></i></a>
									</li>
								</ul>
							</div>
							<div id="container-map" class="col-sm-12 row" style="padding:0!important;margin: 0px;">
								<div class="col-sm-6 input-0 lat">
									<div class="form-group form-group-default">
										<label>Longitude</label>
										<input type="text" required="" name="lng[]" class="form-control" placeholder="Masukan Longitude">
									</div>
								</div>
								<div class="col-sm-6 input-0">
									<div class="form-group form-group-default">
										<label>Latitude</label>
										<input type="text" required="" name="lat[]" class="form-control" placeholder="Masukan Latitude">
									</div>
								</div>


								<div class="col-sm-6 input-0 lat">
									<div class="form-group form-group-default">
										<label>Longitude</label>
										<input type="text" required="" name="lng[]" class="form-control" placeholder="Masukan Longitude">
									</div>
								</div>
								<div class="col-sm-6 input-0">
									<div class="form-group form-group-default">
										<label>Latitude</label>
										<input type="text" required="" name="lat[]" class="form-control" placeholder="Masukan Latitude">
									</div>
								</div>
							

								<div class="col-sm-6 input-0 lat">
									<div class="form-group form-group-default">
										<label>Longitude</label>
										<input type="text" required="" name="lng[]" class="form-control" placeholder="Masukan Longitude">
									</div>
								</div>
								<div class="col-sm-6 input-0">
									<div class="form-group form-group-default">
										<label>Latitude</label>
										<input type="text" required="" name="lat[]" class="form-control" placeholder="Masukan Latitude">
									</div>
								</div>
							
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a class="btn btn-danger btn-rounded" href="{{ url(session('level').'/wilayah') }}">Batal</a>
						<button class="btn btn-rounded btn-success">Submit Data</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('colorpicker/colorpicker.css') }}">
@endsection
@section('js')
<script src="{{ asset('colorpicker/colorpicker.js') }}"></script>
<script>
	$('.colorpicker').colorpicker();

	function add() {
		var html = $("#container-map").html();
		var no = 0 ;
		$(".lat").each(function(){
			no++;
		});

		var new_el =
		'<div class="col-sm-6 input-'+no+' lat">'+
		'<div class="form-group form-group-default">'+
		'<label>Longitude</label>'+
		'<input type="text" required="" name="lng[]" class="form-control" placeholder="Masukan Longitude">'+
		'</div>'+
		'</div>'+
		'<div class="col-sm-6 input-'+no+'">'+
		'<div class="form-group form-group-default">'+
		'<label>Latitude</label>'+
		'<input type="text" required="" name="lat[]" class="form-control" placeholder="Masukan Latitude">'+
		'</div>'+
		'</div>';
		// alert(new_el);
		$("#container-map").html(html+new_el);
	}

	function del() {
		var no = 0 ;
		$(".lat").each(function(){
			no++;
		});
		if (no>3) {
			var html = "";

			for (var i = 0; i <= no -2 ; i++) {
				html+=
				'<div class="col-sm-6 input-'+i+' lat">'+
				'<div class="form-group form-group-default">'+
				'<label>Longitude</label>'+
				'<input type="text" required="" name="lng[]" class="form-control" placeholder="Masukan Longitude">'+
				'</div>'+
				'</div>'+
				'<div class="col-sm-6 input-'+i+'">'+
				'<div class="form-group form-group-default">'+
				'<label>Latitude</label>'+
				'<input type="text" required="" name="lat[]" class="form-control" placeholder="Masukan Latitude">'+
				'</div>'+
				'</div>';
			}

			$("#container-map").html(html);
		}
	}
</script>
@endsection