@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.article') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.article.index') }}"><span>{{ trans('admin.article.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.article.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.article.recycle') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.article.subject') }}</dt>
			<dd><input type="text" name="subject" class="schtxt" value="{{ request('subject') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.article.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.article.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="50">{{ trans('admin.id') }}</th>
				<th>{{ trans('admin.article.subject') }}</th>
				<th width="100">{{ trans('admin.article.subweb') }}</th>
				<th width="100">{{ trans('admin.article.viewnum') }}</th>
				<th width="150">{{ trans('admin.created_at') }}</th>
				<th width="150">{{ trans('admin.deleted_at') }}</th>
				<th width="70">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($articles as $article)
			<tr>
				<td>{{ $article->article_id }}</td>
				<td>{{ $article->subject }}</td>
				<td>{{ $article->subweb->name or '/' }}</td>
				<td>{{ $article->viewnum }} 次</td>
				<td>{{ $article->created_at->format('Y-m-d H:i') }}</td>
				<td>{{ $article->deleted_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.article.restore',$article->article_id) }}" class="restorebtn" title="{{ trans('admin.article.restore') }}">{{ trans('admin.restore') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($articles) > 0)
	<div class="pgs cl">
		<div class="page y">
			{!! $articles->appends(['subject' => request('subject')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection