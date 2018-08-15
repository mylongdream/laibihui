@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.menu') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.wechat.menu.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.wechat.menu.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.wechat.menu.index') }}" class="btn">< {{ trans('admin.wechat.menu.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.menu.parentid') }}</td>
					<td>
						<select id="parentid" class="select" name="parentid">
							<option value="">请选择上级菜单</option>
							@foreach ($menulist as $value)
							<option value="{{ $value->id }}">{{ str_repeat('->',$value->count-1) }}{{ $value->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.wechat.menu.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.wechat.menu.type') }}</td>
					<td>
						<select name="type" class="select typeselect">
							<option value="">请选择菜单类型</option>
							@foreach ($menutype as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tbody class="typesub" id="type_click" style="display:none">
				<tr>
					<td align="right">关键字</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[click][key]">
					</td>
				</tr>
				</tbody>
				<tbody class="typesub" id="type_view" style="display:none">
				<tr>
					<td align="right">链接网址</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[view][url]">
					</td>
				</tr>
				</tbody>
				<tbody class="typesub" id="type_miniprogram" style="display:none">
				<tr>
					<td align="right">链接网址</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[miniprogram][url]"><span class="tdtip">老版本客户端将打开本url</span>
					</td>
				</tr>
				<tr>
					<td align="right">小程序appid</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[miniprogram][appid]">
					</td>
				</tr>
				<tr>
					<td align="right">小程序页面路径</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[miniprogram][pagepath]"><span class="tdtip">如：pages/index/index</span>
					</td>
				</tr>
				</tbody>
				<tr>
					<td align="right">排序</td>
					<td><input class="txt" type="text" size="50" value="0" name="displayorder"></td>
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
	<script type="text/javascript">
        $(function() {
            $(".typeselect").change(function() {
                $('.typesub').hide();
                if($(this).val()){
                    $('#type_'+$(this).val()).show();
                }
            }).trigger("change");
        });
	</script>
@endsection