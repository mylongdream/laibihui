@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.history') }}</div>
				</div>
				@if (count($historys))
				@foreach ($historys as $value)
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd"><a href="{{ route('mobile.user.history.delete', $value->id) }}" title="删除" class="delete delbtn">删除</a></div>
						<div class="weui-panel__bd">
							<a href="{{ route('mobile.brand.shop.show', $value->shop->id) }}" class="weui-media-box weui-media-box_appmsg">
								<div class="weui-media-box__hd">
									<img class="weui-media-box__thumb" src="{{ uploadImage($value->shop->upimage) }}" alt="">
								</div>
								<div class="weui-media-box__bd">
									<h4 class="weui-media-box__title">{{ $value->shop ? $value->shop->name : '/' }}</h4>
									<p class="weui-media-box__desc">电话：{{ $value->shop ? $value->shop->phone : '/' }}</p>
									<p class="weui-media-box__desc">地址：{{ $value->shop ? $value->shop->address : '/' }}</p>
								</div>
							</a>
						</div>
					</div>
				@endforeach
				{!! $historys->links() !!}
				@else
					<div class="no-data">
						<p>暂无数据！</p>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection