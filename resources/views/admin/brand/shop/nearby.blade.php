@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.shop') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.brand.shop.index') }}"><span>{{ trans('admin.brand.shop.list') }}</span></a></li>
			<li><a href="{{ route('admin.brand.shop.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.shop.qrcode') }}</h3></div>
				<div class="y"><a href="{{ route('admin.brand.shop.index') }}" class="btn">< {{ trans('admin.brand.shop.list') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="30%">{{ trans('admin.brand.shop.name') }}</th>
				<th>{{ trans('admin.brand.shop.address') }}</th>
				<th width="20%">相距距离</th>
			</tr>
			@foreach ($shops as $value)
				<tr>
					<td><a href="{{ route('brand.shop.show',$value->id) }}" target="_blank">{{ $value->name }}</a></td>
					<td>{{ $value->address }}</td>
					<td>{{ number_format($value->distance) }} 米</td>
				</tr>
			@endforeach
		</table>
	</div>
@endsection