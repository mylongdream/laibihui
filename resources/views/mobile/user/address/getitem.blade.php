@extends('layouts.mobile.app')

@section('content')
	@if ($address)
		<div class="weui-cell weui-cell_access open-popup" data-target="#address_list" data-url="{{ route('mobile.user.address.getlist', ['id' => $address->id]) }}">
			<div class="weui-cell__bd">
				<p style="margin-bottom: 5px;">{{ $address->realname }}<span class="mlm">{{ $address->mobile }}</span> </p>
				<p style="font-size: 13px;color: #888888;">
					@if (auth()->user()->address_id == $address->id)
						<span class="weui-badge" style="margin-right: 5px;">默认</span>
					@endif
					{{ $address->getprovince ? $address->getprovince->name : '' }} {{ $address->getcity ? $address->getcity->name : '' }} {{ $address->getarea ? $address->getarea->name : '' }} {{ $address->getstreet ? $address->getstreet->name : '' }}</p>
				<p style="font-size: 13px;color: #888888;">{{ $address->address }}</p>
			</div>
			<div class="weui-cell__ft"><input type="hidden" name="addressid" value="{{ $address->id }}"></div>
		</div>
	@else
		<div class="address_add open-popup" data-target="#address_add" data-url="{{ route('mobile.user.address.getadd') }}">
			<a href="javascript:;"><span>添加新地址</span></a>
		</div>
	@endif
@endsection
