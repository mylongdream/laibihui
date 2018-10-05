@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.user') }}</h3></div>
	</div>
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.wechat.user.show') }}</h3></div>
				<div class="y"><a href="{{ route('admin.wechat.user.index') }}" class="btn">< {{ trans('admin.wechat.user.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.subscribe') }}</td>
					<td>{{ $user->subscribe }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.openid') }}</td>
					<td>{{ $user->openid }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.nickname') }}</td>
					<td>{{ $user->nickname }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.sex') }}</td>
					<td>{{ $user->sex }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.language') }}</td>
					<td>{{ $user->language }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.country') }}</td>
					<td>{{ $user->country }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.province') }}</td>
					<td>{{ $user->province }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.city') }}</td>
					<td>{{ $user->city }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.subscribe_time') }}</td>
					<td>{{ $user->subscribe_time }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.remark') }}</td>
					<td>{{ $user->remark }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.tagid_list') }}</td>
					<td>{{ $user->tagid_list }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.subscribe_scene') }}</td>
					<td>{{ $user->subscribe_scene }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.qr_scene') }}</td>
					<td>{{ $user->qr_scene }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.user.qr_scene_str') }}</td>
					<td>{{ $user->qr_scene_str }}</td>
				</tr>
			</table>
		</div>
@endsection