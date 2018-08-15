@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.group') }}</h3></div>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.crm.group.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="200">{{ trans('admin.crm.group.name') }}</th>
				<th>{{ trans('admin.crm.group.description') }}</th>
				<th width="200">{{ trans('admin.crm.group.module') }}</th>
			</tr>
			@foreach (config('crm.group') as $key => $value)
			<tr>
				<td>{{ $value['name'] }}</td>
				<td>{{ $value['description'] }}</td>
				<td>{{ $key }}</td>
			</tr>
			@endforeach
		</table>
	</div>
@endsection