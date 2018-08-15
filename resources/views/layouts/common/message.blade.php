@extends('layouts.common.app')

@section('content')
	<div class="messagebox">
		<div class="messagetip">
			<p class="infotitle">{{ $info }}</p>
			<p class="marginbot">
				@if (isset($url))
					<a href="{{ $url }}">如果您的浏览器没有自动跳转，请点击这里</a>
				@else
					<a href="javascript:history.back(-1);">请点击这里返回上一页</a>
				@endif
			</p>
		</div>
	</div>
@endsection