@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.tag') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.wechat.tag.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.wechat.tag.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.wechat.tag.index') }}" class="btn">< {{ trans('admin.wechat.tag.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.tag.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection