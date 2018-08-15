@extends('layouts.common.simple')

@section('content')
    @foreach (auth()->user()->addresses as $value)
        <div class="address-item {{ auth()->user()->address_id == $value->id ? 'on' : '' }}" data-id="{{ $value->id }}">
            <dl>
                <dt>
                    <span>{{ $value->realname }}</span>
                    <a href="{{ route('user.address.edit', ['id' => $value->id]) }}" class="openwindow" title="修改地址">修改</a>
                </dt>
                <dd>{{ $value->mobile }}</dd>
                <dd>
                    <p>{{ $value->getprovince ? $value->getprovince->name : '' }} {{ $value->getcity ? $value->getcity->name : '' }} {{ $value->getarea ? $value->getarea->name : '' }} {{ $value->getstreet ? $value->getstreet->name : '' }}</p>
                    <p>{{ $value->address }}</p>
                </dd>
            </dl>
        </div>
    @endforeach
@endsection

