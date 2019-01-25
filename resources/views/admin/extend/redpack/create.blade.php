@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.announce') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.announce.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.announce.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.announce.index') }}" class="btn">< {{ trans('admin.extend.announce.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.announce.title') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.announce.message') }}</td>
					<td><textarea class="textarea" name="message" cols="60" rows="5" id="message" style="width:100%;height:400px"></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.announce.jumpurl') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="jumpurl"><span class="tdtip">填写此处将会直接跳转至该链接</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="30" value="0" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="{{ asset('static/js/kindeditor/kindeditor.js') }}"></script>
	<script type="text/javascript">
        KindEditor.ready(function(K) {
            var ItemEditor = K.create("#message", {
                uploadJson : "{{ route('admin.upload.editor') }}",
                extraFileUploadParams : {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                afterBlur: function () { this.sync(); }
            });
        });
	</script>
@endsection