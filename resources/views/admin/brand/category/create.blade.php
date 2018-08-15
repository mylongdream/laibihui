@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.category') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.brand.category.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.brand.category.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.brand.category.index') }}" class="btn">< {{ trans('admin.brand.category.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.category.parentid') }}</td>
					<td>
						<select id="parentid" class="select" name="parentid">
							<option value="">请选择上级菜单</option>
							@foreach ($categorylist as $scategory)
							<option value="{{ $scategory->id }}">{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.category.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.category.upimage') }}</td>
					<td>
						<a href="javascript:;" class="clickbtn" id="upimage">上传图片</a><span class="tdtip"></span>
						<div class="uploadbox"><ul></ul></div>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.category.description') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="description"></td>
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