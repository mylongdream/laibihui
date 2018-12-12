@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.applysell') }}</h3></div>
	</div>
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.crm.applysell.show') }}</h3></div>
				<div class="y"><a href="{{ route('admin.crm.applysell.index') }}" class="btn">< {{ trans('admin.crm.applysell.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.realname') }}</td>
					<td>{{ $info->realname }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.mobile') }}</td>
					<td>{{ $info->mobile }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.age') }}</td>
					<td>{{ $info->age }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.idcard') }}</td>
					<td>{{ $info->idcard }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.location') }}</td>
					<td>{{ $info->getprovince ? $info->getprovince->name : '' }}{{ $info->getcity ? $info->getcity->name : '' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.idcardpic') }}</td>
					<td>
						@if ($info->idcardpic)
						<img src="{{ uploadImage($info->idcardpic) }}" alt="">
						@endif
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.grantpic') }}</td>
					<td>
						@if ($info->grantpic)
							<img src="{{ uploadImage($info->grantpic) }}" alt="">
						@endif
					</td>
				</tr>
			</table>
		</div>
@endsection