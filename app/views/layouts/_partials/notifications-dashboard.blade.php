<!-- TODO: work on these error messages -->

@if (Alert::has('error'))
    {{ Alert::first('error', '<div class="notification-bar error">:message</div>') }}
@endif

@if (Alert::has('success'))
	{{ Alert::first('success', '<div class="notification-bar success">:message</div>') }}
@endif

@if (Alert::has('info'))
	{{ Alert::first('info', '<div class="notification-bar info">:message</div>') }}
@endif

<script type="text/javascript">
$(document).ready(function() {
	$('.notification-bar').delay(4000).slideUp(750);
});
</script>