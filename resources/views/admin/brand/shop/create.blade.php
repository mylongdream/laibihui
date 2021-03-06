@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.shop') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.brand.shop.index') }}"><span>{{ trans('admin.brand.shop.list') }}</span></a></li>
			<li><a href="{{ route('admin.brand.shop.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.brand.shop.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span>{{ trans('admin.info_base') }}</span></li>
						<li><span>{{ trans('admin.brand.shop.message') }}</span></li>
						<li><span>{{ trans('admin.brand.shop.function') }}</span></li>
						<li><span>{{ trans('admin.brand.shop.manage') }}</span></li>
						<li><span>{{ trans('admin.info_seo') }}</span></li>
					</ul>
				</div>
				<div class="y"><a href="{{ route('admin.brand.shop.index') }}" class="btn">< {{ trans('admin.brand.shop.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.shop.subweb') }}</td>
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
					<td width="150" align="right">{{ trans('admin.brand.shop.category') }}</td>
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
					<td align="right">{{ trans('admin.brand.shop.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.upphoto') }}</td>
					<td>
						<a href="javascript:;" class="clickbtn" id="upphoto">上传图片</a><span class="tdtip">建议尺寸为 800 X 800 像素大小，大小2M以下（可拖拽图片调整显示顺序）</span>
						<div class="uploadbox uploader-list"><ul></ul></div>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.banner') }}</td>
					<td>
                        <a href="javascript:;" class="clickbtn" id="banner">上传图片</a><span class="tdtip">建议尺寸为 1190 X 120 像素大小</span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.openhours') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="openhours"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.address') }}</td>
					<td><textarea class="textarea" name="address" cols="60" rows="4"></textarea></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.mappoint') }}</td>
					<td>
						<input class="txt" type="text" size="15" value="" name="maplng" id="maplng"> X <input class="txt" type="text" size="15" value="" name="maplat" id="maplat">
						<a href="javascript:;" class="clickbtn mlm" id="mapmark">点击标注</a>
						<a href="{{ route('admin.brand.shop.nearby') }}" class="clickbtn mlm openwindow" title="附近店铺">附近店铺</a>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.phone') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="phone"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.mobile') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="mobile"><span class="tdtip">用于接收短信通知，前台不显示</span></td>
				</tr>
                <tr>
                    <td align="right">{{ trans('admin.brand.shop.discount') }}</td>
                    <td><input class="txt" type="text" size="20" value="" name="discount"> 折</td>
                </tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.indiscount') }}</td>
					<td><input class="txt" type="text" size="20" value="" name="indiscount"> 折<span class="tdtip">公司与商家签订的合同折扣，前台不显示</span></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.expiry') }}</td>
					<td><input id="starttime" class="txt" type="text" size="20" value="" name="started_at"> 至 <input id="endtime" class="txt" type="text" size="20" value="" name="ended_at"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.viewnum') }}</td>
					<td><input class="txt" type="text" size="20" value="0" name="viewnum"> 次<span class="tdtip">设置显示浏览的次数，以后在此基础上累加</span></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.shop.message') }}</td>
					<td><textarea class="textarea" name="message" id="message" style="width:100%;height:400px"></textarea></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.shop.offline') }}</td>
					<td>
						<label class="radio" for="offline_1">
							<input id="offline_1" type="radio" name="offline" value="1"> {{ trans('admin.brand.shop.offline_1') }}
						</label>
						<label class="radio" for="offline_0">
							<input id="offline_0" type="radio" name="offline" value="0" checked> {{ trans('admin.brand.shop.offline_0') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.appoint') }}</td>
					<td>
						<label class="radio" for="appoint_1">
							<input id="appoint_1" type="radio" name="appoint" value="1"> {{ trans('admin.brand.shop.appoint_1') }}
						</label>
						<label class="radio" for="appoint_0">
							<input id="appoint_0" type="radio" name="appoint" value="0" checked> {{ trans('admin.brand.shop.appoint_0') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.ordermeal') }}</td>
					<td>
						<label class="radio" for="ordermeal_1">
							<input id="ordermeal_1" type="radio" name="ordermeal" value="1"> {{ trans('admin.brand.shop.ordermeal_1') }}
						</label>
						<label class="radio" for="ordermeal_0">
							<input id="ordermeal_0" type="radio" name="ordermeal" value="0" checked> {{ trans('admin.brand.shop.ordermeal_0') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.sellcard') }}</td>
					<td>
						<label class="radio" for="sellcard_1">
							<input id="sellcard_1" type="radio" name="sellcard" value="1"> {{ trans('admin.brand.shop.sellcard_1') }}
						</label>
						<label class="radio" for="sellcard_0">
							<input id="sellcard_0" type="radio" name="sellcard" value="0" checked> {{ trans('admin.brand.shop.sellcard_0') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.giftcard') }}</td>
					<td>
						<label class="radio" for="giftcard_1">
							<input id="giftcard_1" type="radio" name="giftcard" value="1"> {{ trans('admin.brand.shop.giftcard_1') }}
						</label>
						<label class="radio" for="giftcard_0">
							<input id="giftcard_0" type="radio" name="giftcard" value="0" checked> {{ trans('admin.brand.shop.giftcard_0') }}
						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.shop.superior') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="superior"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.shop.moderator') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="moderator"></td>
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
            $("#banner").powerWebUpload({
                server: "{{ route('admin.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'banner',
                width: 595,
                height: 60
            });
            $("#mapmark").amap({
                AddressId: '#address',
                maplngId: '#maplng',
                maplatId: '#maplat'
            });
            laydate({
                elem: '#starttime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
            });
            laydate({
                elem: '#endtime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
            });
        });
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