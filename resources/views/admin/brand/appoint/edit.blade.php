@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.appoint') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.brand.appoint.update', $appoint->id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.brand.appoint.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.brand.appoint.index') }}" class="btn">< {{ trans('admin.brand.appoint.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.order_sn') }}</td>
					<td>{{ $appoint->order_sn or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.realname') }}</td>
					<td>{{ $appoint->realname }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.mobile') }}</td>
					<td>{{ $appoint->mobile or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.number') }}</td>
					<td>{{ $appoint->number or '0' }} 人</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.appoint_at') }}</td>
					<td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.remark') }}</td>
					<td>{{ $appoint->remark or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.status') }}</td>
					<td>
						<label class="radio" for="status_0" onclick="$('#result_box').hide()">
							<input id="status_0" type="radio" name="status" value="0" {{ $appoint->status == 0 ? 'checked' : '' }}> {{ trans('admin.brand.appoint.status_0') }}
						</label>
						<label class="radio" for="status_1" onclick="$('#result_box').show()">
							<input id="status_1" type="radio" name="status" value="1" {{ $appoint->status == 1 ? 'checked' : '' }}> {{ trans('admin.brand.appoint.status_1') }}
						</label>
						<label class="radio" for="status_2" onclick="$('#result_box').show()">
							<input id="status_2" type="radio" name="status" value="2" {{ $appoint->status == 2 ? 'checked' : '' }}> {{ trans('admin.brand.appoint.status_2') }}
						</label>
						<label class="radio" for="status_3" onclick="$('#result_box').show()">
							<input id="status_3" type="radio" name="status" value="3" {{ $appoint->status == 3 ? 'checked' : '' }}> {{ trans('admin.brand.appoint.status_3') }}
						</label>
					</td>
				</tr>
				<tbody id="result_box" class="{{ $appoint->status == 0 ? 'hidden' : '' }}">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.appoint.reason') }}</td>
					<td><textarea class="textarea" name="reason" cols="60" rows="4">{{ $appoint->reason }}</textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection