@if (Session::has('success'))
	<script type="text/javascript">
		toastr.success("{{ Session::get('success') }}");
	</script>
@elseif (Session::has('warning'))
	<script type="text/javascript">
		toastr.warning("{{ Session::get('warning') }}");
	</script>
@elseif (Session::has('error'))
	<script type="text/javascript">
		toastr.error("{{ Session::get('error') }}");
	</script>
@elseif (Session::has('info'))
	<script type="text/javascript">
		toastr.info("{{ Session::get('info') }}");
	</script>
@endif