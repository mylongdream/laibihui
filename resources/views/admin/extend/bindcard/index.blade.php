@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.bindcard') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.bindcard.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.bindcard.number') }}</dt>
			<dd><input type="text" name="number" class="schtxt" value="{{ request('number') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.bindcard.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.bindcard.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="140">{{ trans('admin.extend.bindcard.user') }}</th>
				<th>{{ trans('admin.extend.bindcard.number') }}</th>
				<th width="80">{{ trans('admin.extend.bindcard.money') }}</th>
				<th width="140">{{ trans('admin.extend.bindcard.fromuser') }}</th>
				<th width="140">{{ trans('admin.extend.bindcard.fromupuser') }}</th>
				<th width="120">{{ trans('admin.extend.bindcard.postip') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="70">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($bindcards as $bindcard)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $bindcard->id }}" name="ids[]"></td>
				<td>{{ $bindcard->user ? $bindcard->user->username : '/' }}</td>
				<td>{{ $bindcard->number or '/' }}</td>
				<td>{{ $bindcard->money }} 元</td>
				<td>{{ $bindcard->fromuser ? $bindcard->fromuser->username : '/' }}</td>
				<td>{{ $bindcard->fromupuser ? $bindcard->fromupuser->username : '/' }}</td>
				<td>{{ $bindcard->postip }}</td>
				<td>{{ $bindcard->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.bindcard.destroy',$bindcard->id) }}" class="delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($bindcards) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
        <div class="page y">
            {!! $bindcards->appends(['number' => request('number')])->links() !!}
        </div>
    </div>
	@endif
	</form>
@endsection