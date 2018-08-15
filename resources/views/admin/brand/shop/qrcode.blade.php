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
				<th align="center">二维码边长(cm)</th>
				<th align="center" width="30%">建议扫描距离(米)</th>
				<th align="center" width="30%">下载链接</th>
			</tr>
			<tr>
				<td align="center">8cm</td>
				<td align="center">0.5m</td>
				<td align="center"><a href="{{ route('admin.brand.shop.getqrcode', ['id' => $shop->id, 'pixsize' => '224']) }}">下载</a></td>
			</tr>
			<tr>
				<td align="center">12cm</td>
				<td align="center">0.8m</td>
				<td align="center"><a href="{{ route('admin.brand.shop.getqrcode', ['id' => $shop->id, 'pixsize' => '336']) }}">下载</a></td>
			</tr>
			<tr>
				<td align="center">15cm</td>
				<td align="center">1m</td>
				<td align="center"><a href="{{ route('admin.brand.shop.getqrcode', ['id' => $shop->id, 'pixsize' => '420']) }}">下载</a></td>
			</tr>
			<tr>
				<td align="center">30cm</td>
				<td align="center">1.5m</td>
				<td align="center"><a href="{{ route('admin.brand.shop.getqrcode', ['id' => $shop->id, 'pixsize' => '840']) }}">下载</a></td>
			</tr>
			<tr>
				<td align="center">50cm</td>
				<td align="center">2.5m</td>
				<td align="center"><a href="{{ route('admin.brand.shop.getqrcode', ['id' => $shop->id, 'pixsize' => '1400']) }}">下载</a></td>
			</tr>
		</table>
	</div>
@endsection