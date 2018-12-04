@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.grantcancel') }}</h3></div>
	</div>
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.crm.grantcancel.show') }}</h3></div>
				<div class="y"><a href="{{ route('admin.crm.grantcancel.index') }}" class="btn">< {{ trans('admin.crm.grantcancel.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.grantcancel.user') }}</td>
					<td>{{ $info->user ? $info->user->username : '' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.grantcancel.topuser') }}</td>
					<td>{{ $info->topuser ? $info->topuser->username : '' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.grantcancel.created_at') }}</td>
					<td>{{ $info->created_at ? $info->created_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
			</table>
		</div>
@endsection