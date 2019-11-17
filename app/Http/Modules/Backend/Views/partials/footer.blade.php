@if (Auth::check())
	<footer class="main-footer">
		<strong>Copyright &copy; {{ date('Y').' '.$BaseLibrary->companyName }}. &nbsp;All Rights Reserved.</strong>
		<div class="pull-right hidden-xs">
			<b>Developed by {{ $BaseLibrary->companyName }} IT</b>
		</div>
	</footer>

	<div class="control-sidebar-bg"></div>
@endif