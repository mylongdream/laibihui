@extends('admin.layouts.app')

@section('content')

	<div class="messagetip">
		<p class="infotitle">{{ $info }}</p>
		<p class="marginbot"><a href="{{ $url }}">如果您的浏览器没有自动跳转，请点击这里</a></p>
	</div>

	<script type="text/javascript">
		var url = "{{ $url }}";
        window.setTimeout(function () {
            if(url){
                window.location.href = url;
            } else {
                location.reload();
            }
        }, 3000);
	</script>
@endsection