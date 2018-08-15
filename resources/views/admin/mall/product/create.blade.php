@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.mall.product') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.mall.product.index') }}"><span>{{ trans('admin.mall.product.list') }}</span></a></li>
			<li><a href="{{ route('admin.mall.product.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.mall.product.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span>{{ trans('admin.info_base') }}</span></li>
						<li><span>{{ trans('admin.mall.product.message') }}</span></li>
						<li><span>{{ trans('admin.info_seo') }}</span></li>
					</ul>
				</div>
				<div class="y"><a href="{{ route('admin.mall.product.index') }}" class="btn">< {{ trans('admin.mall.product.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.product.category') }}</td>
					<td>
						<select class="select" name="catid">
							<option value="">请选择</option>
							@foreach ($categorylist as $scategory)
								<option value="{{ $scategory->id }}">{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.product.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.mall.product.upimage') }}</td>
					<td>
                        <a href="javascript:;" class="upbtn" id="upimage">上传图片</a><span class="tdtip"></span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.mall.product.upphoto') }}</td>
					<td>
                        <a href="javascript:;" class="upbtn" id="upphoto">上传图片</a><span class="tdtip"></span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.mall.product.price') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="price"> 元<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.mall.product.score') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="score"> 个<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.mall.product.stock') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="stock"><span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.mall.product.sellnum') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="sellnum"><span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.mall.product.viewnum') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="viewnum"> 次<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.product.onsale') }}</td>
					<td>
						<label class="radio" for="onsale_1">
							<input id="onsale_1" type="radio" name="onsale" value="1" checked> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="onsale_0">
							<input id="onsale_0" type="radio" name="onsale" value="0"> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.product.message') }}</td>
					<td><textarea class="textarea" name="message" id="message" style="width:100%;height:400px"></textarea></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="" name="seo_title"></td>
				</tr>
				<tr>
					<td align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="" name="seo_keywords"></td>
				</tr>
				<tr>
					<td align="right">seo_description</td>
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