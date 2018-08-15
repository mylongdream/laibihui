@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.cardreward') }}</div>
				</div>
				<div class="weui-panel" style="margin: 0">
					<div class="weui-msg">
						<div class="weui-msg__text-area">
							<h2 class="weui-msg__title">当前已售卡 <span style="font-size: 36px;margin: 0 10px">0</span> 张</h2>
						</div>
					</div>
				</div>
                <div class="weui-cells weui-panel cardreward">
					@if ($list)
					<ul>
						@foreach ($list as $value)
							<li>
								<div class="pic"><img src="{{ uploadImage($value->upimage) }}" width="60" height="60"></div>
								<div class="name">{{ $value->name }}</div>
								<div class="info">所需卡数：{{ $value->cardnum }}张</div>
								<div class="btn"><a href="javascript:;" class="disabled">点击兑换</a></div>
							</li>
						@endforeach
					</ul>
					@endif
                </div>
				{!! $list->links() !!}
			</div>
		</div>
	</div>
@endsection
