@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.address') }}</div>
				</div>
				@if (count($addresses))
				@foreach ($addresses as $value)
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd">
							<div class="z">
								<a href="{{ route('mobile.user.address.edit',$value->id) }}" class="edit">编辑</a>
								<a href="{{ route('mobile.user.address.destroy',$value->id) }}" class="mlw delete delbtn">删除</a>
							</div>
						</div><div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_text">
                                <h4 class="weui-media-box__title"><span>{{ $value->realname }}</span><strong class="mlm">{{ $value->mobile }}</strong></h4>
                                <p class="weui-media-box__desc">
                                    @if (auth()->user()->address_id == $value->id)
                                        <span class="weui-badge" style="margin-right: 5px;">默认</span>
                                    @endif
                                    <span>{{ $value->getprovince ? $value->getprovince->name : '' }}{{ $value->getcity ? $value->getcity->name : '' }}{{ $value->getarea ? $value->getarea->name : '' }}{{ $value->getstreet ? $value->getstreet->name : '' }}{{ $value->address }}</span>
                                </p>
                            </div>
                        </div>
					</div>
				@endforeach
				{!! $addresses->links() !!}
				@else
					<div class="no-data">
						<p>暂无数据！</p>
					</div>
				@endif
			</div>
		</div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="{{ route('mobile.user.address.create') }}" class="weui-tabbar__item tabbar-btn">
                <span>新建收货地址</span>
            </a>
        </div>
	</div>
@endsection
