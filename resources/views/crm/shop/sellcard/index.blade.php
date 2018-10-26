@extends('layouts.crm.app')

@section('content')
	<div class="crm-tabnav">
		<ul>
			<li class="on"><a href="{{ route('crm.shop.sellcard.index') }}">办卡二维码</a></li>
			<li><a href="{{ route('crm.shop.sellcard.order') }}">售卡记录</a></li>
		</ul>
	</div>
	<div class="crm-main">
		<div class="crm-infobox">
			<div class="hd">
				<h4>办卡二维码</h4>
			</div>
			<div class="bd" style="text-align: center;">
				<img style="width:350px;" src="{{ route('crm.shop.sellcard.index', ['getcode' => 1]) }}" alt="">
			</div>
		</div>
	</div>
@endsection