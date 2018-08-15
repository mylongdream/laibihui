@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.comment') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.comment.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.comment.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="120">{{ trans('admin.brand.comment.user') }}</th>
				<th width="200">{{ trans('admin.brand.comment.shop') }}</th>
				<th>{{ trans('admin.brand.comment.message') }}</th>
				<th width="120">{{ trans('admin.brand.comment.postip') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($commentlist as $comment)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $comment->id }}" name="ids[]"></td>
				<td>{{ $comment->user ? $comment->user->username : '/' }}</td>
				<td>
					@if ($comment->shop)
						<a href="{{ route('brand.shop.show', $comment->shop->id) }}" target="_blank" title="{{ $comment->shop->name }}">{{ $comment->shop->name }}</a>
					@else
						/
					@endif
				</td>
				<td>{{ $comment->message }}</td>
				<td>{{ $comment->postip }}</td>
				<td>{{ $comment->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($commentlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $commentlist->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection