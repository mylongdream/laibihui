@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.card') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.card.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.card.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.card.index') }}" class="btn">< {{ trans('admin.extend.card.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.card.length') }}</td>
					<td><input class="txt" type="text" size="30" value="16" name="length"><span class="tdtip">必须大于卡号前缀长度</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.card.prefix') }}</td>
					<td><input class="txt" type="text" size="30" value="" name="prefix"><span class="tdtip">可以填写如区号：0571</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.card.count') }}</td>
					<td><input class="txt" type="text" size="30" value="10000" name="count"><span class="tdtip">最多可以生成100000张</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.card.pwdlength') }}</td>
					<td><input class="txt" type="text" size="30" value="8" name="pwdlength"><span class="tdtip">最长可以为20位</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.card.money') }}</td>
					<td><input class="txt" type="text" size="30" value="100" name="money"> 元<span class="tdtip">卡内默认余额</span></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="批量生成" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection