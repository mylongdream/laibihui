@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.menu') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.wechat.menu.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.wechat.menu.list') }}</h3></div>
			<div class="y">
				<a href="{{ route('admin.wechat.menu.create') }}" class="btn openwindow" title="{{ trans('admin.wechat.menu.create') }}">+ {{ trans('admin.wechat.menu.create') }}</a>
				<a href="{{ route('admin.wechat.menu.publish') }}" class="btn ajaxbtn" title="{{ trans('admin.wechat.menu.publish') }}">{{ trans('admin.wechat.menu.publish') }}</a>
			</div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.displayorder') }}</th>
				<th width="250">{{ trans('admin.wechat.menu.name') }}</th>
				<th width="200">{{ trans('admin.wechat.menu.type') }}</th>
				<th>{{ trans('admin.wechat.menu.message') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($menulist as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{!! str_repeat('<div class="childnode">',$value->count-1) !!}<input type="text" class="txt" name="displayorder[{{ $value->id }}]" value="{{ $value->displayorder }}" style="width:40px">{!! str_repeat('</div>',$value->count-1) !!}</td>
				<td>{!! str_repeat('<div class="childnode">',$value->count-1) !!}<input type="text" class="txt" name="name[{{ $value->id }}]" value="{{ $value->name }}">{!! str_repeat('</div>',$value->count-1) !!}</td>
				<td>{{ $value->type ? $menutype[$value->type] : '/' }}</td>
				<td>
					@if ($value->message)
					@foreach (unserialize($value->message) as $k => $val)
						<p><strong>{{ $k }}：</strong>{{ $val }}</p>
					@endforeach
					@else
						/
					@endif
				</td>
				<td>
					<a href="{{ route('admin.wechat.menu.edit',$value->id) }}" class="openwindow" title="{{ trans('admin.wechat.menu.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.wechat.menu.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($menulist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection