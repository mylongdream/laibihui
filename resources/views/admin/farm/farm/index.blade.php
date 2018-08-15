@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.farm.farm') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.farm.farm.index') }}"><span>{{ trans('admin.farm.farm.list') }}</span></a></li>
			<li><a href="{{ route('admin.farm.farm.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.farm.farm.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.farm.farm.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.farm.farm.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.farm.farm.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.farm.farm.create') }}" class="btn" title="{{ trans('admin.farm.farm.create') }}">+ {{ trans('admin.farm.farm.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.farm.farm.name') }}</th>
				<th width="80">{{ trans('admin.farm.farm.price') }}</th>
				<th width="120">{{ trans('admin.farm.farm.phone') }}</th>
				<th width="90">{{ trans('admin.farm.farm.subweb') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="150">{{ trans('admin.operation') }}</th>
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
					<a href="{{ route('admin.farm.package.index',['farmid' => $value->id]) }}" title="{{ trans('admin.farm.package.list') }}" class="">{{ trans('admin.farm.package.list') }}</a>
					<a href="{{ route('admin.farm.farm.edit',$value->id) }}" title="{{ trans('admin.farm.farm.edit') }}" class="mlm">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.farm.farm.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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