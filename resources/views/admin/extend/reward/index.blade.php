@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.reward') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.extend.reward.index', ['type' => 1]) }}"><span>会员兑换</span></a></li>
			<li><a href="{{ route('admin.extend.reward.index', ['type' => 2]) }}"><span>商家兑换</span></a></li>
		</ul>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.reward.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.reward.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.extend.reward.create', ['type' => request('type')]) }}" class="btn openwindow" title="{{ trans('admin.extend.reward.create') }}">+ {{ trans('admin.extend.reward.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.extend.reward.upimage') }}</th>
				<th>{{ trans('admin.extend.reward.name') }}</th>
				<th width="150">{{ trans('admin.extend.reward.cardnum') }}</th>
				<th width="100">{{ trans('admin.extend.reward.onsale') }}</th>
				<th width="150">{{ trans('admin.extend.reward.created_at') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($rewardlist as $reward)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $reward->id }}" name="ids[]"></td>
				<td><img src="{{ uploadImage($reward->upimage) }}" width="60" height="60"></td>
				<td>{{ $reward->name }}</td>
				<td>{{ $reward->cardnum }}</td>
				<td>{{ $reward->onsale ? trans('admin.yes') : trans('admin.no') }}</td>
				<td>{{ $reward->created_at ? $reward->created_at->format('Y-m-d H:i') : '/' }}</td>
				<td>
					<a href="{{ route('admin.extend.reward.edit',$reward->id) }}" class="openwindow" title="{{ trans('admin.extend.reward.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.extend.reward.destroy',$reward->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($rewardlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection