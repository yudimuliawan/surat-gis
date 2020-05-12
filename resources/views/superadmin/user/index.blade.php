@extends('superadmin.layout')
@section('title','SPRI - User Management')
@section('content')

<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">User Management</h4>
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
				<a href="#">User Management</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">List User</h4>
						<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#add">
							<i class="fa fa-plus"></i>
							Tambah Data
						</button>
					</div>
				</div>
				<div class="card-body">
					<!-- Modal -->
					<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header no-bd">
									<h5 class="modal-title">
										<span class="fw-mediumbold">Tambah</span> 
										<span class="fw-light">Data</span>
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form method="post" action="{{ Route('user.store') }}">
									@csrf
									<div class="modal-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Nama</label>
													<input type="text" required="" name="name" class="form-control" placeholder="Masukan Nama">
												</div>
												<div class="form-group form-group-default">
													<label>Level</label>
													<select name="level" class="form-control" required="" id="">
														<option>Superadmin</option>
														<option>Penerima Surat KPP</option>
														<option>Kepala Bidang KPP</option>
														<option>Kepala Seksi PRL</option>
														<option>Staff Seksi PRL</option>
														<option>Pegawai Cabang Dinas</option>
													</select>
												</div>
												<div class="form-group form-group-default">
													<label>No Handphone</label>
													<input type="number" required="" name="no_hp" class="form-control" placeholder="Masukan No Handphone">
												</div>
												<div class="form-group form-group-default">
													<label>Username</label>
													<input type="text" required="" name="username" class="form-control" placeholder="Masukan Username">
												</div>
												<div class="form-group form-group-default">
													<label>Password</label>
													<input type="password" required="" name="password" class="form-control" placeholder="Masukan Password">
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer no-bd">
										<button type="submit" class="btn btn-primary">Submit</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					@foreach ($list as $e)
					<div class="modal fade" id="upd{{ $e->id }}" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header no-bd">
									<h5 class="modal-title">
										<span class="fw-mediumbold">Update</span> 
										<span class="fw-light">Data</span>
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form method="post" action="{{ Route('user.update',$e->id) }}">
									@csrf @method('patch')
									<div class="modal-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Nama</label>
													<input type="text" required="" value="{{ $e->name }}" name="name" class="form-control" placeholder="Masukan Nama">
												</div>
												<div class="form-group form-group-default">
													<label>Level</label>
													<select name="level" class="form-control" required="" id="">
														<option {{ $e->level==strtolower(str_replace(' ','_','Superadmin')) ? 'selected' : '' }} >Superadmin</option>
														<option {{ $e->level==strtolower(str_replace(' ','_','Penerima Surat KPP')) ? 'selected' : '' }} >Penerima Surat KPP</option>
														<option {{ $e->level==strtolower(str_replace(' ','_','Kepala Bidang KPP')) ? 'selected' : '' }} >Kepala Bidang KPP</option>
														<option {{ $e->level==strtolower(str_replace(' ','_','Kepala Seksi PRL')) ? 'selected' : '' }} >Kepala Seksi PRL</option>
														<option {{ $e->level==strtolower(str_replace(' ','_','Staff Seksi PRL')) ? 'selected' : '' }} >Staff Seksi PRL</option>
														<option {{ $e->level=='Pegawai Cabang Dinas' ? 'selected' : '' }} >Pegawai Cabang Dinas</option>
													</select>
												</div>
												<div class="form-group form-group-default">
													<label>No Handphone</label>
													<input type="number" required="" value="{{ $e->no_hp }}" name="no_hp" class="form-control" placeholder="Masukan No Handphone">
												</div>
												<div class="form-group form-group-default">
													<label>Username</label>
													<input type="text" required="" value="{{ $e->username }}" name="username" class="form-control" placeholder="Masukan Username">
												</div>
												<div class="form-group form-group-default">
													<label>Password</label>
													<input type="password" name="password" class="form-control" placeholder="Masukan Password">
													<small class="text-danger">Isi jika ingin diganti</small>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer no-bd">
										<button type="submit" class="btn btn-primary">Submit</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					@endforeach

					<div class="table-responsive">
						<table id="add-row" class="display table datatable table-striped table-hover" >
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Username</th>
									<th>No Hp</th>
									<th>Level</th>
									<th style="width: 10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list as $e)
								<tr>
									<td>{{ $loop->index + 1}}</td>
									<td>{{ $e->name }}</td>
									<td>{{ $e->username }}</td>
									<td>{{ $e->no_hp }}</td>
									<td>
										<span class="badge badge-secondary">{{ ucfirst(str_replace('_',' ',$e->level)) }}</span>
									</td>
									<td>
										<form action="{{ Route('user.destroy',$e->id) }}" method="post" id="form-{{ $e->id }}">
											@csrf @method('delete')
											<div class="form-button-action">
												<input type="hidden" name="id" value="{{ $e->id }}">
												<button type="button" class="btn btn-sm btn-rounded btn-primary" data-toggle="modal" data-target="#upd{{ $e->id }}" >
													<i class="fa fa-edit"></i>
												</button>
												<button type="button" class="btn btn-sm btn-rounded btn-danger" onclick="confdel({{ $e->id }})">
													<i class="fa fa-times"></i>
												</button>
											</div>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.datatable').DataTable({
		});

	});
	function confdel(id) {
		swal({
			title: 'Hapus data?',
			text: 'Semua data yang berhubungan dengan data ini akan ikut terhapus!',
			icon: 'warning',
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$("#form-"+id).submit();
			}
		});
	}
</script>
@endsection