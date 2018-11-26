@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.reward') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.reward.update') }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3>{{ trans('admin.setting.reward') }}</h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.userregscore') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_userregscore'] or '' }}" name="setting[reward_userregscore]"> 个<span class="tdtip">推荐注册成功可获得的积分个数</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.userreg') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_userreg'] or '' }}" name="setting[reward_userreg]"> 元<span class="tdtip">推荐注册并成功办卡可得的奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.topuserreg') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_topuserreg'] or '' }}" name="setting[reward_topuserreg]"> 元<span class="tdtip">推荐注册并成功办卡上级可得的奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.investment') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_investment'] or '' }}" name="setting[reward_investment]"> 元<span class="tdtip">成功招商一位商户按标牌价每递减10%（0.1折）</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.shopsellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_shopsellcard'] or '' }}" name="setting[reward_shopsellcard]"> 元<span class="tdtip">商户成功卖卡一张奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.topshopsellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_topshopsellcard'] or '' }}" name="setting[reward_topshopsellcard]"> 元<span class="tdtip">负责商户成功卖卡的客户经理奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.usersellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_usersellcard'] or '' }}" name="setting[reward_usersellcard]"> 元<span class="tdtip">推广业务员成功卖卡一张奖励金额</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.reward.topusersellcard') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['reward_topusersellcard'] or '' }}" name="setting[reward_topusersellcard]"> 元<span class="tdtip">推广业务员成功卖卡一张上级奖励金额</span></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection