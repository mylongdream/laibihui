@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.faqcate') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.extend.faq.index') }}"><span>{{ trans('admin.extend.faq.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.extend.faqcate.index') }}"><span>{{ trans('admin.extend.faqcate.list') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.faqcate.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.faqcate.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.faqcate.index') }}" class="btn">< {{ trans('admin.extend.faqcate.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.faqcate.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection