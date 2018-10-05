@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.menu') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.wechat.menu.index') }}">
		<div class="tbsearch">
			<dl>
				<dt>分组菜单</dt>
				<dd>
					<select class="schselect" name="tag_id" onchange="this.form.submit()" style="width:160px">
						<option value="0">默认</option>
						@foreach ($taglist as $value)
							<option value="{{ $value->id }}" {!! request('tag_id') == $value->id ? 'selected="selected"' : '' !!}>{{ $value->name }}</option>
						@endforeach
					</select>
				</dd>
			</dl>
			<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
		</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.wechat.menu.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.wechat.menu.list') }}</h3></div>
			<div class="y">
				<a href="{{ route('admin.wechat.menu.create', ['tag_id' => request('tag_id')]) }}" class="btn openwindow" title="{{ trans('admin.wechat.menu.create') }}">+ {{ trans('admin.wechat.menu.create') }}</a>
				<a href="{{ route('admin.wechat.menu.publish', ['tag_id' => request('tag_id')]) }}" class="btn ajaxbtn" title="{{ trans('admin.wechat.menu.publish') }}">{{ trans('admin.wechat.menu.publish') }}</a>
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
					@switch($value->type)
					@case('click')
					<p>{{ $value->keyword ? $value->keyword : '/' }}</p>
					@break
					@case('view')
					<p>{{ $value->url ? $value->url : '/' }}</p>
					@break
					@case('miniprogram')
					<p>{{ $value->url ? $value->url : '/' }}</p>
					<p>{{ $value->appid ? $value->appid : '/' }}</p>
					<p>{{ $value->pagepath ? $value->pagepath : '/' }}</p>
					@break
					@case('media_id')
					@case('view_limited')
					<p>{{ $value->media_id ? $value->media_id : '/' }}</p>
					@break
					@default
					@endswitch
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