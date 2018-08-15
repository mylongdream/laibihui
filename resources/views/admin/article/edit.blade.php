@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.article') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.article.index') }}"><span>{{ trans('admin.article.list') }}</span></a></li>
			<li><a href="{{ route('admin.article.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.article.update', $article->article_id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span>{{ trans('admin.info_base') }}</span></li>
						<li><span>{{ trans('admin.info_seo') }}</span></li>
					</ul>
				</div>
				<div class="y"><a href="{{ route('admin.article.index') }}" class="btn">< {{ trans('admin.article.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.article.subweb') }}</td>
					<td>
						<select name="subweb_id" id="subweb_id" class="select select_subweb">
							<option value="0">请选择</option>
							@foreach ($subwebs as $subweb)
								@if ($article->subweb == $subweb)
									<option value="{{ $subweb->subweb_id }}" selected>[{{ $subweb->firstletter }}]{{ $subweb->name }}</option>
								@else
									<option value="{{ $subweb->subweb_id }}">[{{ $subweb->firstletter }}]{{ $subweb->name }}</option>
								@endif
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.subject') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $article->subject }}" name="subject"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.subjectimage') }}</td>
					<td><input class="txt" type="text" size="34" value="{{ $article->subjectimage }}" name="subjectimage" id="uploadipt_image"><a href="javascript:;" class="upbtn" id="uploadbtn_image">上传图片</a></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.desc') }}</td>
					<td><textarea class="textarea" name="desc" cols="60" rows="4">{{ $article->desc }}</textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.message') }}</td>
					<td><textarea id="content" class="textarea" name="message" style="width:100%;height:450px;">{{ $article->message }}</textarea></td>
				</tr>
                <tr>
                    <td align="right">{{ trans('admin.article.jumpurl') }}</td>
                    <td><input class="txt" type="text" size="50" value="{{ $article->jumpurl }}" name="jumpurl"><span class="tdtip">不填则不进行跳转</span></td>
                </tr>
				<tr>
					<td align="right">{{ trans('admin.article.viewnum') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $article->viewnum }}" name="viewnum"> 次<span class="tdtip">设置显示浏览的次数，以后在此基础上累加</span></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="{{ $article->seo_title }}" name="seo_title"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="{{ $article->seo_keywords }}" name="seo_keywords"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_description</td>
					<td><textarea class="textarea" name="seo_description" cols="60" rows="5">{{ $article->seo_description }}</textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	@include('admin.upload.image')
	<script type="text/javascript" src="{{ asset('static/js/kindeditor/kindeditor.js') }}"></script>
	<script type="text/javascript">
		KindEditor.ready(function(K) {
			var ItemEditor = K.create("#content", {
				resizeType : 1,
				urlType : "absolute",
				uploadJson : "{{ route('admin.upload.editor') }}",
				extraFileUploadParams : {
					_token : $('meta[name="csrf-token"]').attr('content')
				},
				afterBlur: function () { this.sync(); }
			});
		});
	</script>
@endsection