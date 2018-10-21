@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.user') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.user.user.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.user.user.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.admin.user.index') }}" class="btn">< {{ trans('admin.user.user.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.user.username') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="username"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.user.password') }}</td>
					<td><input class="txt" type="password" size="50" value="" name="password"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.user.password_confirmation') }}</td>
					<td><input class="txt" type="password" size="50" value="" name="password_confirmation"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.user.user.headimgurl') }}</td>
					<td>
						<a href="javascript:;" class="clickbtn" id="headimgurl">上传图片</a><span class="tdtip">建议尺寸为 320 X 320 像素大小</span>
						<div class="uploadbox"><ul></ul></div>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.user.realname') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="realname"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.user.mobile') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="mobile"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.user.qq') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="qq"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#headimgurl").powerWebUpload({
                server: "{{ route('admin.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                InputId: 'headimgurl',
                width: 120,
                height: 120
            });
        });
	</script>
@endsection