@php
use App\User;
$user = User::find(session('id_user'));
$url = Request::segment('2');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<link rel="stylesheet" href="{{ asset('assets/css/fonts.min.css') }}">

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
	@yield('css')
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="{{ url(session('level')) }}" class="logo">
					<img src="{{ asset('assets/img/logo.svg') }}" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ asset('assets/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ $user->name }}</h4>
												<p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										{{-- <a class="dropdown-item" href="#">My Profile</a>
										<a class="dropdown-item" href="#">My Balance</a>
										<a class="dropdown-item" href="#">Inbox</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Account Setting</a>
										<div class="dropdown-divider"></div> --}}
										<a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ $user->name }}
									<span class="user-level">{{ ucfirst(str_replace('_', ' ', session('level'))) }}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									{{-- <li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li> --}}
									{{-- <li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li> --}}
									<li>
										<a href="{{ url('logout') }}">
											<span class="link-collapse">Logout</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item {{ $url=="" ? 'active' : '' }} ">
							<a href="{{ url(session('level')) }}"  >
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu Utama</h4>
						</li>
						<li class="nav-item {{ $url=="user" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/user') }}"  >
								<i class="fas fa-users"></i>
								<p>Manage User</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Surat</h4>
						</li>
						<li class="nav-item {{ $url=="salinan_surat" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/salinan_surat') }}"  >
								<i class="fas fa-envelope"></i>
								<p>Salinan Surat</p>
							</a>
						</li>
						<li class="nav-item {{ $url=="disposisi" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/disposisi') }}"  >
								<i class="fas fa-stream"></i>
								<p>Disposisi</p>
							</a>
						</li>

						<li class="nav-item {{ $url=="permohonan_verlok" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/permohonan_verlok') }}"  >
								<i class="fas fa-file-alt"></i>
								<p>Permohonan Verlok</p>
							</a>
						</li>

						<li class="nav-item {{ $url=="laporan_verlok" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/laporan_verlok') }}"  >
								<i class="fas fa-file-alt"></i>
								<p>Laporan Verlok</p>
							</a>
						</li>

						<li class="nav-item {{ $url=="rekomendasi" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/rekomendasi') }}"  >
								<i class="fas fa-file-alt"></i>
								<p>Surat Rekomendasi</p>
							</a>
						</li>

						<li class="nav-item {{ $url=="koordinat" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/koordinat') }}"  >
								<i class="fas fa-map-marked"></i>
								<p>Data Koordinat</p>
							</a>
						</li>

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Manage Map</h4>
						</li>

						<li class="nav-item {{ $url=="wilayah" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/wilayah') }}"  >
								<i class="fas fa-map"></i>
								<p>Wilayah</p>
							</a>
						</li>

						<li class="nav-item {{ $url=="map" ? 'active' : '' }} ">
							<a href="{{ url(session('level').'/map') }}"  >
								<i class="fa fa-map-marker-alt"></i>
								<p>Koordinat Map</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				@yield('content')
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
	</div>
	
	<!--   Core JS Files   -->
	<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
	<!-- jQuery UI -->
	<script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
	<!-- Atlantis JS -->
	<script src="{{asset('assets/js/atlantis.min.js')}}"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{asset('assets/js/setting-demo2.js')}}"></script>
	<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
	@include('alert')
	@yield('js')
</body>
</html>