@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.article') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.article.index') }}"><span>{{ trans('admin.article.list') }}</span></a></li>
			<li><a href="{{ route('admin.article.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.article.store') }}">
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
								<option value="{{ $subweb->subweb_id }}">[{{ $subweb->firstletter }}]{{ $subweb->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.subject') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="subject"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.subjectimage') }}</td>
					<td>
                        <a href="javascript:;" class="upbtn" id="upload_image">上传图片</a><span class="tdtip"></span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.desc') }}</td>
					<td><textarea class="textarea" name="desc" cols="60" rows="4"></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.article.message') }}</td>
					<td><textarea id="content" class="textarea" name="message" style="width:100%;height:450px;"></textarea></td>
				</tr>
                <tr>
                    <td align="right">{{ trans('admin.article.jumpurl') }}</td>
                    <td><input class="txt" type="text" size="50" value="" name="jumpurl"><span class="tdtip">不填则不进行跳转</span></td>
                </tr>
				<tr>
					<td align="right">{{ trans('admin.article.viewnum') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="viewnum"> 次<span class="tdtip">设置显示浏览的次数，以后在此基础上累加</span></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="" name="seo_title"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="" name="seo_keywords"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_description</td>
					<td><textarea class="textarea" name="seo_description" cols="60" rows="5"></textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/kindeditor/kindeditor.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#upload_image").powerWebUpload({
                server: "{{ route('admin.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'image_id',
                width: 420,
                height: 120
            });
        });
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