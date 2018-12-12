@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.giftcard') }}</h3></div>
	</div>
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.crm.giftcard.show') }}</h3></div>
				<div class="y"><a href="{{ route('admin.crm.giftcard.index') }}" class="btn">< {{ trans('admin.crm.giftcard.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.giftcard.realname') }}</td>
					<td>{{ $info->realname }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.giftcard.mobile') }}</td>
					<td>{{ $info->mobile }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.giftcard.age') }}</td>
					<td>{{ $info->age }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.giftcard.idcard') }}</td>
					<td>{{ $info->idcard }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.giftcard.location') }}</td>
					<td>{{ $info->getprovince ? $info->getprovince->name : '' }}{{ $info->getcity ? $info->getcity->name : '' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.giftcard.idcardpic') }}</td>
					<td>
						@if ($info->idcardpic)
						<img src="{{ uploadImage($info->idcardpic) }}" alt="">
						@endif
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.giftcard.grantpic') }}</td>
					<td>
						@if ($info->grantpic)
							<img src="{{ uploadImage($info->grantpic) }}" alt="">
						@endif
					</td>
				</tr>
			</table>
		</div>
@endsection