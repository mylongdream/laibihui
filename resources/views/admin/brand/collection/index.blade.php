@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.collection') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.collection.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.collection.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.brand.collection.user') }}</th>
				<th>{{ trans('admin.brand.collection.shop') }}</th>
				<th width="140">{{ trans('admin.brand.collection.postip') }}</th>
				<th width="140">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($collectionlist as $collection)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $collection->id }}" name="ids[]"></td>
				<td>{{ $collection->user ? $collection->user->username : '/' }}</td>
				<td>
					@if ($collection->shop)
						<a href="{{ route('brand.shop.show', $collection->shop->id) }}" target="_blank" title="{{ $collection->shop->name }}">{{ $collection->shop->name }}</a>
					@else
						/
					@endif
				</td>
				<td>{{ $collection->postip }}</td>
				<td>{{ $collection->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($collectionlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $collectionlist->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection