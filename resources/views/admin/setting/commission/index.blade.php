@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.commission') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.commission.update') }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3>{{ trans('admin.setting.commission') }}</h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.commission.investment') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['commission_investment'] or '' }}" name="setting[commission_investment]"> 元<span class="tdtip">成功招商一位商户按标牌价每递减10%（0.1折）</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.commission.shopsellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['commission_shopsellcard'] or '' }}" name="setting[commission_shopsellcard]"> 元<span class="tdtip">商户成功卖卡一张奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.commission.topshopsellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['commission_topshopsellcard'] or '' }}" name="setting[commission_topshopsellcard]"> 元<span class="tdtip">负责商户成功卖卡的客户经理奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.commission.usersellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['commission_usersellcard'] or '' }}" name="setting[commission_usersellcard]"> 元<span class="tdtip">推广业务员成功卖卡一张奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.commission.topusersellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['commission_topusersellcard'] or '' }}" name="setting[commission_topusersellcard]"> 元<span class="tdtip">推广业务员成功卖卡一张上级奖励金额</span></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection