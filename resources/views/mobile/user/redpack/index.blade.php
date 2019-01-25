@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.redpack') }}</div>
				</div>
                <div class="weui-cells weui-panel">
				@foreach ($redpacks as $value)
					<div class="weui-cell">
						<div class="weui-cell__bd">
                            <p style="font-size: 14px;">{{ $value->remark }}</p>
                            <p style="font-size: 12px;color: #999;margin-top: 5px">时间：{{ $value->created_at->format('Y-m-d H:i') }}</p>
						</div>
                        <div class="weui-cell__ft">
                            @if ($value->redpack > 0)
                                <strong style="color:#e4393c">+{{ $value->redpack }}</strong>
                            @else
                                <strong style="color:#999999">{{ $value->redpack }}</strong>
                            @endif
                        </div>
					</div>
				@endforeach
                </div>
				{!! $redpacks->links() !!}
			</div>
		</div>
	</div>
@endsection
