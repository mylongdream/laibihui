@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">订卡记录</div>
				</div>
                <div class="weui-cells weui-panel">
				@foreach ($list as $value)
					<div class="weui-cell">
						<div class="weui-cell__bd">
                            <p style="font-size: 14px;">卡数：{{ $value->cardnum }} 张</p>
                            <p style="font-size: 12px;color: #999;margin-top: 5px">时间：{{ $value->created_at->format('Y-m-d H:i') }}</p>
						</div>
                        <div class="weui-cell__ft">
                                <strong style="color:#999999">{{ $value->status ? '已处理' : '待处理' }}</strong>
                        </div>
					</div>
				@endforeach
                </div>
				{!! $list->links() !!}
			</div>
		</div>
	</div>
@endsection
