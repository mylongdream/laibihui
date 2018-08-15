@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.activity') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.activity.index') }}"><span>{{ trans('admin.activity.list') }}</span></a></li>
			<li><a href="{{ route('admin.activity.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.activity.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span>{{ trans('admin.info_base') }}</span></li>
						<li><span>{{ trans('admin.info_seo') }}</span></li>
					</ul>
				</div>
				<div class="y"><a href="{{ route('admin.activity.index') }}" class="btn">< {{ trans('admin.activity.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.activity.city') }}</td>
					<td>
						<select name="province_id" id="province_id" class="select select_province"></select>
						<select name="city_id" id="city_id" class="select select_city"></select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.activity.subject') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="subject"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.activity.subjectimage') }}</td>
					<td><input class="txt" type="text" size="34" value="" name="subjectimage" id="uploadipt_image"><a href="javascript:;" class="upbtn" id="uploadbtn_image">上传图片</a></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.activity.desc') }}</td>
					<td><textarea class="textarea" name="desc" cols="60" rows="4"></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.activity.message') }}</td>
					<td><textarea id="content" class="textarea" name="message" style="width:100%;height:450px;"></textarea></td>
				</tr>
                <tr>
                    <td align="right">{{ trans('admin.activity.jumpurl') }}</td>
                    <td><input class="txt" type="text" size="50" value="" name="jumpurl"><span class="tdtip">不填则不进行跳转</span></td>
                </tr>
				<tr>
					<td align="right">{{ trans('admin.activity.viewnum') }}</td>
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
	@include('admin.upload.image')
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