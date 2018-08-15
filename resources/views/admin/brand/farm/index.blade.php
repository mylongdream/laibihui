@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.farm') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.brand.farm.index') }}"><span>{{ trans('admin.brand.farm.list') }}</span></a></li>
			<li><a href="{{ route('admin.brand.farm.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.farm.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.brand.farm.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.farm.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.farm.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.brand.farm.create') }}" class="btn" title="{{ trans('admin.brand.farm.create') }}">+ {{ trans('admin.brand.farm.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.brand.farm.name') }}</th>
				<th width="80">{{ trans('admin.brand.farm.price') }}</th>
				<th width="120">{{ trans('admin.brand.farm.phone') }}</th>
				<th width="90">{{ trans('admin.brand.farm.subweb') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($farms as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td><a href="{{ route('brand.farm.show',$value->id) }}" target="_blank">{{ $value->name }}</a></td>
				<td>{{ $value->price }} 元</td>
				<td>{{ $value->phone }}</td>
				<td>{{ $value->subweb->name or '/' }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.farm.edit',$value->id) }}" title="{{ trans('admin.brand.farm.edit') }}" class="">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.brand.farm.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($farms) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $farms->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection