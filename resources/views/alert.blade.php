<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script>
	@if (session('success')!=null)
	$.notify({
		icon : 'fa fa-check',
		message : '{{ session('success') }}',
	},{
		type: 'success',
		placement: {
			from: 'top',
			align: 'right'
		},
		time: 1000,
		delay: 0,
	});
	@endif

	@if (session('error')!=null)
	$.notify({
		icon : 'fa fa-info',
		message : '{{ session('error') }}',
	},{
		type: 'danger',
		placement: {
			from: 'top',
			align: 'right'
		},
		time: 1000,
		delay: 0,
	});
	@endif

	@if($errors->any())
	@foreach($errors->all() as $e)
	$.notify({
		icon : 'fa fa-info',
		message : '{{ $e }}',
	},{
		type: 'danger',
		placement: {
			from: 'top',
			align: 'right'
		},
		time: 1000,
		delay: 0,
	});
	@endforeach
	@endif

</script>