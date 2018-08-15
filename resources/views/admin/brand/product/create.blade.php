@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.product') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.brand.product.index') }}"><span>{{ trans('admin.brand.product.list') }}</span></a></li>
			<li><a href="{{ route('admin.brand.product.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.brand.product.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.brand.product.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.brand.product.index') }}" class="btn">< {{ trans('admin.brand.product.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.product.shop') }}</td>
					<td>
						<select class="select" name="shop_id">
							<option value="">请选择</option>
							@foreach ($shoplist as $shop)
								<option value="{{ $shop->id }}" {!! $shop->id == request('shopid') ? 'selected="selected"' : '' !!}>{{ $shop->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.product.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.product.upimage') }}</td>
					<td>
                        <a href="javascript:;" class="upbtn" id="upimage">上传图片</a><span class="tdtip"></span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.product.upphoto') }}</td>
					<td>
                        <a href="javascript:;" class="upbtn" id="upphoto">上传图片</a><span class="tdtip"></span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.product.message') }}</td>
					<td><textarea class="textarea" name="message" id="message" style="width:100%;height:400px"></textarea></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.product.viewnum') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="viewnum"> 次<span class="tdtip">设置显示浏览的次数，以后在此基础上累加</span></td>
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
    <script type="text/javascript" src="{{ asset('static/js/kindeditor/kindeditor.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#upimage").powerWebUpload({
                server: "{{ route('admin.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upimage',
                width: 120,
                height: 120
            });
            $("#upphoto").powerWebUpload({
                server: "{{ route('admin.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upphoto[]',
                fileNumLimit: 5,
                width: 120,
                height: 120
            });
        });
        KindEditor.ready(function(K) {
            var ItemEditor = K.create("#message", {
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