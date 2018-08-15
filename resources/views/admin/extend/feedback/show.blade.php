@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.feedback') }}</h3></div>
	</div>
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.feedback.show') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.feedback.index') }}" class="btn">< {{ trans('admin.extend.feedback.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.feedback.user') }}</td>
					<td>{{ $feedback->user ? $feedback->user->username : '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.feedback.message') }}</td>
					<td>{!! nl2br($feedback->message) !!}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.feedback.upphoto') }}</td>
					<td>
                        <div class="uploadbox">
                            <ul>
                                @if ($feedback->upphoto)
                                    @foreach (unserialize($feedback->upphoto) as $upphoto)
                                        <li>
                                            <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.feedback.phone') }}</td>
					<td>{{ $feedback->phone ? $feedback->phone : '/' }}</td>
				</tr>
			</table>
		</div>
@endsection