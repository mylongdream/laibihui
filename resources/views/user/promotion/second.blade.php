@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.promotion') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('user.promotion.index') }}"><span>{{ trans('user.promotion.rule') }}</span></a></li>
			<li><a href="{{ route('user.promotion.first') }}"><span>{{ trans('user.promotion.first') }}</span></a></li>
			<li class="on"><a href="{{ route('user.promotion.second') }}"><span>{{ trans('user.promotion.second') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('user.promotion.second') }}">
		<div class="tbsearch">
			<dl>
				<dd>
					<select class="schselect" name="bindcard" onchange='this.form.submit()'>
						<option value="0">全部</option>
						<option value="1" {!! request('bindcard') == 1 ? 'selected="selected"' : '' !!}>未开卡</option>
						<option value="2" {!! request('bindcard') == 2 ? 'selected="selected"' : '' !!}>已开卡</option>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>{{ trans('user.promotion.username') }}</dt>
				<dd><input type="text" name="username" class="schtxt" value="{{ request('username') }}"></dd>
			</dl>
			<div class="schbtn"><button name="" type="submit">搜索</button></div>
		</div>
	</form>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left">{{ trans('user.promotion.username') }}</th>
				<th align="center">{{ trans('user.promotion.consume_money') }}</th>
				<th align="center" width="120">{{ trans('user.promotion.created_at') }}</th>
			</tr>
			@if (count($promotions))
				@foreach ($promotions as $value)
					<tr>
						<td align="left">{{ $value->user ? $value->user->username : '/' }}</td>
						<td align="center">{{ $value->user ? $value->user->consume_money : '0' }} 元</td>
						<td align="center">{{ $value->created_at->format('Y-m-d H:i') }}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="3" align="center" class="nodata">暂无数据</td>
				</tr>
			@endif
		</table>
	</div>
	{!! $promotions->appends(['lower' => request('lower')])->appends(['username' => request('username')])->links() !!}
@endsection