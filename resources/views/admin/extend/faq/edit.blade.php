@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.faq') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.extend.faq.index') }}"><span>{{ trans('admin.extend.faq.list') }}</span></a></li>
			<li><a href="{{ route('admin.extend.faqcate.index') }}"><span>{{ trans('admin.extend.faqcate.list') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.faq.update', $faq->id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.faq.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.faq.index') }}" class="btn">< {{ trans('admin.extend.faq.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.faq.catid') }}</td>
					<td>
						<select name="catid" class="select">
							<option value="0">请选择</option>
							@foreach ($faqcategory as $value)
								<option value="{{ $value->id }}" {{ $faq->catid == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.faq.title') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $faq->title }}" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.faq.message') }}</td>
					<td><textarea class="textarea" name="message" cols="60" rows="5">{{ $faq->message }}</textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $faq->displayorder }}" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection