@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.shop') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.brand.shop.index') }}"><span>{{ trans('admin.brand.shop.list') }}</span></a></li>
			<li><a href="{{ route('admin.brand.shop.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.shop.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.brand.shop.category') }}</dt>
			<dd>
				<select class="schselect" name="catid">
					<option value="">请选择</option>
					@foreach ($categorylist as $scategory)
						<option value="{{ $scategory->id }}" {!! request('catid') == $scategory->id ? 'selected="selected"' : '' !!}>{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
					@endforeach
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.brand.shop.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.shop.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.shop.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.brand.shop.create') }}" class="btn" title="{{ trans('admin.brand.shop.create') }}">+ {{ trans('admin.brand.shop.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="70">ID/{{ trans('admin.brand.shop.searchcode') }}</th>
				<th>{{ trans('admin.brand.shop.name') }}</th>
				<th width="80">{{ trans('admin.brand.shop.category') }}</th>
				<th width="60">{{ trans('admin.brand.shop.discount') }}</th>
				<th width="90">{{ trans('admin.brand.shop.subweb') }}</th>
				<th width="120">{{ trans('admin.ended_at') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="150">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($shops as $shop)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $shop->id }}" name="ids[]"></td>
				<td>{{ $shop->id }}</td>
				<td><a href="{{ route('brand.shop.show',$shop->id) }}" target="_blank">{{ $shop->name }}</a></td>
				<td>{{ $shop->category ? $shop->category->name : '/' }}</td>
				<td>{{ $shop->discount }} 折</td>
				<td>{{ $shop->subweb->name or '/' }}</td>
				<td>{{ $shop->ended_at ? $shop->ended_at->format('Y-m-d H:i') : '/' }}</td>
				<td>{{ $shop->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.shop.qrcode',$shop->id) }}" title="{{ trans('admin.brand.shop.qrcode') }}" class="openwindow">{{ trans('admin.brand.shop.qrcode') }}</a>
					<a href="{{ route('admin.brand.shop.edit',$shop->id) }}" title="{{ trans('admin.brand.shop.edit') }}" class="mlm">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.brand.shop.destroy',$shop->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($shops) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $shops->appends(['catid' => request('catid')])->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection