@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.archive') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.crm.archive.update', $archive->id) }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.crm.archive.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.crm.archive.index') }}" class="btn">< {{ trans('admin.crm.archive.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.shop.name') }}</td>
					<td>{{ $archive->shop->name }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.archive.status') }}</td>
					<td>
						<label class="radio" for="status_1" onclick="$('.status_reason').hide()">
							<input id="status_1" type="radio" name="status" value="1" > {{ trans('admin.crm.archive.status_1') }}
						</label>
						<label class="radio" for="status_2" onclick="$('.status_reason').show()">
							<input id="status_2" type="radio" name="status" value="2" checked> {{ trans('admin.crm.archive.status_2') }}
						</label>
					</td>
				</tr>
				<tr class="status_reason">
					<td width="150" align="right">{{ trans('admin.crm.archive.reason') }}</td>
					<td><textarea class="textarea" name="reason" cols="60" rows="5"></textarea></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection