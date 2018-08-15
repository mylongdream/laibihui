@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.meal') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.brand.meal.index') }}"><span>{{ trans('admin.brand.meal.list') }}</span></a></li>
			<li><a href="{{ route('admin.brand.mealcate.index') }}"><span>{{ trans('admin.brand.mealcate.list') }}</span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.brand.meal.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.brand.meal.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.brand.meal.index') }}" class="btn">< {{ trans('admin.brand.meal.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.meal.shop') }}</td>
					<td>
						<select name="shop_id" class="select select_shop">
							<option value="0">请选择</option>
							@foreach ($shoplist as $value)
								<option value="{{ $value->id }}" {{ request('shopid') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.meal.category') }}</td>
					<td>
						<select name="catid" class="select select_category">
							<option value="0">默认分类</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.meal.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.meal.upimage') }}</td>
					<td>
						<a href="javascript:;" class="clickbtn" id="upimage">上传图片</a><span class="tdtip">建议尺寸为 800 X 800 像素大小</span>
						<div class="uploadbox"><ul></ul></div>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.meal.price') }}</td>
					<td><input class="txt" type="text" size="30" value="" name="price"> 元</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.meal.message') }}</td>
					<td><textarea class="textarea" name="message" cols="60" rows="4"></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.meal.onsale') }}</td>
					<td>
						<label class="radio" for="onsale_1">
							<input id="onsale_1" type="radio" name="onsale" value="1" checked> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="onsale_0">
							<input id="onsale_0" type="radio" name="onsale" value="0"> {{ trans('admin.no') }}
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
            $(document).on("change", ".select_shop", function(){
                var value = $(this).val();
                if(value){
                    $.get("{{ route('admin.brand.meal.getcate') }}", {shop_id: value}, function(data){
                        var optionstring = "";
                        $.each(data.catelist, function(index, item) {
                            optionstring += "<option value="+item.id+">" + item.name+ "</option>";
                        });
                        $(".select_category").html("<option value='0'>默认分类</option>"+optionstring);
                    });
                }else{
                    $(".select_category").html("<option value='0'>默认分类</option>");
                }
            });
            $(".select_shop").trigger("change");
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