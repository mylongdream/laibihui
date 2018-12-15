@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.card') }}</h3></div>
	</div>
	<div style="padding:10px 20px;margin-top:15px;border: 1px solid #cbcbcb;font-size:18px;background:#eee">总卡数：{{ $count->allnum }}张，已分配：{{ $count->allotnum }}张</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.card.index') }}">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="bind" onchange='this.form.submit()'>
					<option value="0">未绑定</option>
                    <option value="1" {!! request('bind') == 1 ? 'selected="selected"' : '' !!}>已绑定</option>
                </select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.extend.card.prefix') }}</dt>
			<dd><input type="text" name="prefix" class="schtxt" value="{{ request('prefix') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform confirmpwd" method="post" action="{{ route('admin.extend.card.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.card.list') }}（共 {!!$cards->total()!!} 条）</h3></div>
			<div class="y">
				<a href="{{ route('admin.extend.card.create') }}" class="btn openwindow confirmpwd" title="{{ trans('admin.extend.card.create') }}">+ {{ trans('admin.extend.card.create') }}</a>
				<a href="{{ route('admin.extend.card.export') }}" class="btn openwindow confirmpwd" title="{{ trans('admin.extend.card.export') }}">{{ trans('admin.extend.card.export') }}</a>
			</div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="160">{{ trans('admin.extend.card.number') }}</th>
				<th>{{ trans('admin.extend.card.password') }}</th>
				<th width="150">{{ trans('admin.extend.card.money') }}</th>
				<th width="150">{{ trans('admin.created_at') }}</th>
				<th width="70">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($cards as $card)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $card->id }}" name="ids[]"></td>
				<td>{{ $card->number or '/' }}</td>
				<td>{{ $card->password or '/' }}</td>
				<td>{{ $card->money }} 元</td>
				<td>{{ $card->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.card.destroy',$card->id) }}" class="delbtn confirmpwd">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($cards) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
        <div class="page y">
            {!! $cards->appends(['bind' => request('bind')])->appends(['prefix' => request('prefix')])->links() !!}
        </div>
    </div>
	@endif
	</form>
@endsection