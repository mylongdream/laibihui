@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.tag') }}</h3></div>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.wechat.tag.list') }}</h3></div>
			<div class="y">
				<a href="{{ route('admin.wechat.tag.create') }}" class="btn openwindow" title="{{ trans('admin.wechat.tag.create') }}">+ {{ trans('admin.wechat.tag.create') }}</a>
			</div>
		</div>
		<table>
			<tr>
				<th width="250">{{ trans('admin.wechat.tag.id') }}</th>
				<th>{{ trans('admin.wechat.tag.name') }}</th>
				<th width="200">{{ trans('admin.wechat.tag.count') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($taglist as $value)
			<tr>
				<td>{{ $value->id }}</td>
				<td>{{ $value->name }}</td>
				<td>{{ $value->count }}</td>
				<td>
					<a href="{{ route('admin.wechat.tag.destroy',$value->id) }}" class="delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	</form>
@endsection