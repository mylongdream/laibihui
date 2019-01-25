@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.redpack') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.redpack.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.redpack.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.redpack.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.redpack.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.extend.redpack.create') }}" class="btn" title="{{ trans('admin.extend.redpack.create') }}">+ {{ trans('admin.extend.redpack.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.extend.redpack.name') }}</th>
				<th width="120">{{ trans('admin.extend.redpack.amount') }}</th>
				<th width="120">{{ trans('admin.extend.redpack.fullamount') }}</th>
				<th width="120">{{ trans('admin.extend.redpack.use_time') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($redpacks as $redpack)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $redpack->id }}" name="ids[]"></td>
				<td>{{ $redpack->name or '/' }}</td>
				<td>{{ $redpack->amount }} 元</td>
				<td>{{ $redpack->fullamount }} 元</td>
				<td>{{ $redpack->use_start->format('Y-m-d H:i') }} - {{ $redpack->use_end->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.redpack.edit',$redpack->id) }}" class="" title="{{ trans('admin.extend.redpack.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.extend.redpack.destroy',$redpack->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($redpacks) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $redpacks->appends(['title' => request('title')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection