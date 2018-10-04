@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.farm.farm') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.farm.farm.index') }}"><span>{{ trans('admin.farm.farm.list') }}</span></a></li>
			<li><a href="{{ route('admin.farm.farm.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.farm.farm.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span>{{ trans('admin.info_base') }}</span></li>
						<li><span>{{ trans('admin.farm.farm.message') }}</span></li>
						<li><span>{{ trans('admin.info_seo') }}</span></li>
					</ul>
				</div>
				<div class="y"><a href="{{ route('admin.farm.farm.index') }}" class="btn">< {{ trans('admin.farm.farm.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.farm.subweb') }}</td>
					<td>
						<select name="subweb_id" class="select select_subweb">
							<option value="0">请选择</option>
							@foreach ($subwebs as $subweb)
								<option value="{{ $subweb->subweb_id }}">[{{ $subweb->firstletter }}]{{ $subweb->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.upphoto') }}</td>
					<td>
						<a href="javascript:;" class="clickbtn" id="upphoto">上传图片</a><span class="tdtip">建议尺寸为 800 X 800 像素大小，大小2M以下（可拖拽图片调整显示顺序）</span>
						<div class="uploadbox uploader-list"><ul></ul></div>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.address') }}</td>
					<td><textarea class="textarea" name="address" cols="60" rows="4"></textarea></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.group') }}</td>
					<td>
						@foreach (config('farm.group') as $key => $value)
							<label class="checkbox" for="group_{{ $key }}">
								<input id="group_{{ $key }}" type="checkbox" name="group[]" value="{{ $key }}"> {{ $value }}
							</label>
						@endforeach
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.play') }}</td>
					<td>
						@foreach (config('farm.play') as $key => $value)
							<label class="checkbox" for="play_{{ $key }}">
								<input id="play_{{ $key }}" type="checkbox" name="play[]" value="{{ $key }}"> {{ $value }}
							</label>
						@endforeach
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.service') }}</td>
					<td>
						@foreach (config('farm.service') as $key => $value)
							<label class="checkbox" for="service_{{ $key }}">
								<input id="service_{{ $key }}" type="checkbox" name="service[]" value="{{ $key }}"> {{ $value }}
							</label>
						@endforeach
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.support') }}</td>
					<td>
						@foreach (config('farm.support') as $key => $value)
							<label class="checkbox" for="support_{{ $key }}">
								<input id="support_{{ $key }}" type="checkbox" name="support[]" value="{{ $key }}"> {{ $value }}
							</label>
						@endforeach
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.mappoint') }}</td>
					<td><input class="txt" type="text" size="15" value="" name="maplng" id="maplng"> X <input class="txt" type="text" size="15" value="" name="maplat" id="maplat">
						<a href="javascript:;" class="clickbtn mlm" id="mapmark">点击标注</a>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.phone') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="phone"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.mobile') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="mobile"><span class="tdtip">用于接收短信通知，前台不显示</span></td>
				</tr>
                <tr>
                    <td align="right">{{ trans('admin.farm.farm.price') }}</td>
                    <td><input class="txt" type="text" size="20" value="" name="price"> 元</td>
                </tr>
				<tr>
					<td align="right">{{ trans('admin.farm.farm.viewnum') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="viewnum"> 次<span class="tdtip">设置显示浏览的次数，以后在此基础上累加</span></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.farm.message') }}</td>
					<td><textarea class="textarea" name="message" id="message" style="width:100%;height:400px"></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.farm.environment') }}</td>
					<td><textarea class="textarea" name="environment" id="environment" style="width:100%;height:400px"></textarea></td>
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
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.amap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.ddsort.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/kindeditor/kindeditor.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            // 图片列表拖动
            $('.uploader-list').DDSort();
            $("#upphoto").powerWebUpload({
                server: "{{ route('admin.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upphoto[]',
                fileNumLimit: 10,
                width: 120,
                height: 120
            });
            $("#mapmark").amap({
                AddressId: '#address',
                maplngId: '#maplng',
                maplatId: '#maplat',
                width: 800,
                height: 500
            });
        });
        KindEditor.ready(function(K) {
            var ItemEditor1 = K.create("#message", {
                uploadJson : "{{ route('admin.upload.editor') }}",
                extraFileUploadParams : {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                afterBlur: function () { this.sync(); }
            });
            var ItemEditor2 = K.create("#environment", {
                uploadJson : "{{ route('admin.upload.editor') }}",
                extraFileUploadParams : {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                afterBlur: function () { this.sync(); }
            });
        });
	</script>

@endsection