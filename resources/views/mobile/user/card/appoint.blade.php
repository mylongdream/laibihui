@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">预约办卡</div>
				</div>
                @foreach ($appoints as $value)
                    <div class="weui-panel panel-item">
                        <div class="weui-panel__bd">
                            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ $value->realname }}</h4>
                                    <p class="weui-media-box__desc">手机：{{ $value->mobile }}</p>
                                    <p class="weui-media-box__desc">地址：{{ $value->address }}</p>
                                </div>
                            </a>
                        </div>
                        <div class="weui-panel__ft">
                            <div class="z status">{{ $value->created_at->format('Y-m-d H:i') }}</div>
                        </div>
                    </div>
                @endforeach
                {!! $appoints->links() !!}
			</div>
		</div>
	</div>
@endsection
