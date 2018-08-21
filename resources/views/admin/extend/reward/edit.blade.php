@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.reward') }}</h3></div>
		<ul class="tab">
			<li{!! $reward->type == 1 ? ' class="current"' : '' !!}><a href="{{ route('admin.extend.reward.index', ['type' => 1]) }}"><span>会员兑换</span></a></li>
			<li{!! $reward->type == 2 ? ' class="current"' : '' !!}><a href="{{ route('admin.extend.reward.index', ['type' => 2]) }}"><span>商家兑换</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.reward.update', $reward->id) }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.reward.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.reward.index') }}" class="btn">< {{ trans('admin.extend.reward.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.reward.type') }}</td>
					<td>
						<select name="type" class="select select_type">
							<option value="0">请选择</option>
							<option value="1" {{ $reward->type == 1 ? 'selected' : '' }}>会员兑换</option>
							<option value="2" {{ $reward->type == 2 ? 'selected' : '' }}>商家兑换</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.reward.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $reward->name }}" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.extend.reward.upimage') }}</td>
					<td>
						<a href="javascript:;" class="clickbtn" id="upimage">上传图片</a><span class="tdtip">建议尺寸为 800 X 800 像素大小</span>
						<div class="uploadbox">
							<ul>
								@if ($reward->upimage)
										<li class="trigger-hover">
											<img src="{{ uploadImage($reward->upimage) }}" width="120" height="120">
											<input name="upimage" value="{{ $reward->upimage }}" type="hidden">
											<div class="handle"><span class="setup">前移</span><span class="setdown">后移</span><span class="setdel">删除</span></div>
										</li>
								@endif
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.reward.cardnum') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $reward->cardnum }}" name="cardnum"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.reward.onsale') }}</td>
					<td>
						<label class="radio" for="onsale_1">
							<input id="onsale_1" type="radio" name="onsale" value="1" {{ $reward->onsale ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="onsale_0">
							<input id="onsale_0" type="radio" name="onsale" value="0" {{ $reward->onsale ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
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
    });
    </script>
@endsection