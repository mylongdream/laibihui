@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.redpack') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.wechat.redpack.index') }}"><span>{{ trans('admin.wechat.redpack.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.wechat.redpack.create') }}"><span>{{ trans('admin.wechat.redpack.create') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.wechat.redpack.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.redpack.send_name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="send_name"><span class="tdtip">红包发送者名称</span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.wechat.redpack.openid') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="openid"><span class="tdtip">接受红包的用户openid</span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.wechat.redpack.total_num') }}</td>
					<td><input class="txt" type="text" size="50" value="1" name="total_num"><span class="tdtip">1为现金红包，大于1为裂变红包</span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.wechat.redpack.total_amount') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="total_amount"><span class="tdtip">付款金额，单位分（100-20000之间）</span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.wechat.redpack.wishing') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="wishing"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.wechat.redpack.act_name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="act_name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.wechat.redpack.remark') }}</td>
					<td><textarea class="textarea" rows="3" cols="50" name="remark"></textarea></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection