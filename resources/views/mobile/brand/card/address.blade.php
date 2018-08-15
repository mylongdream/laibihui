@extends('layouts.mobile.app')

@section('content')
    <div class="wp">
        <div class="weui-cells address-list" style="margin: 0">
            @foreach (auth()->user()->addresses as $value)
                <div class="weui-cell weui-cell_access">
                    <div class="weui-cell__bd">
                        <p style="margin-bottom: 5px;">{{ $value->realname }}<span class="mlm">{{ $value->mobile }}</span> </p>
                        <p style="font-size: 13px;color: #888888;">
                            @if (auth()->user()->address_id == $value->id)
                                <span class="weui-badge" style="margin-right: 5px;">默认</span>
                            @endif
                            {{ $value->getprovince ? $value->getprovince->name : '' }} {{ $value->getcity ? $value->getcity->name : '' }} {{ $value->getarea ? $value->getarea->name : '' }} {{ $value->getstreet ? $value->getstreet->name : '' }}</p>
                        <p style="font-size: 13px;color: #888888;">{{ $value->address }}</p>
                    </div>
                    <div class="weui-cell__ft"><input type="hidden" name="addressid" value="{{ $value->id }}"></div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

