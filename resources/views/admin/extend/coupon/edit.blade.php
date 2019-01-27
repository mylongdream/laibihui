@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.coupon') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.coupon.update', $coupon->id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.coupon.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.coupon.index') }}" class="btn">< {{ trans('admin.extend.coupon.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.coupon.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $coupon->name }}" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.coupon.amount') }}</td>
					<td><input class="txt" type="text" size="30" value="{{ $coupon->amount }}" name="amount"> 元</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.coupon.fullamount') }}</td>
					<td><input class="txt" type="text" size="30" value="{{ $coupon->fullamount }}" name="fullamount"> 元</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.extend.coupon.use_limit') }}</td>
					<td>
						<label class="radio use_limit_tab" for="use_limit_0">
							<input id="use_limit_0" type="radio" name="use_limit" value="0" {{ $coupon->use_limit == 0 ? 'checked' : '' }}> {{ trans('admin.extend.coupon.use_limit_0') }}
						</label>
						<label class="radio use_limit_tab" for="use_limit_1">
							<input id="use_limit_1" type="radio" name="use_limit" value="1" {{ $coupon->use_limit == 1 ? 'checked' : '' }}> {{ trans('admin.extend.coupon.use_limit_1') }}
						</label>
					</td>
				</tr>
				<tr class="use_limit_body {{ $coupon->use_limit == 0 ? '' : 'hidden' }}">
					<td align="right">{{ trans('admin.extend.coupon.use_time') }}</td>
					<td><input id="starttime" class="txt" type="text" size="20" value="{{ $coupon->use_start }}" name="use_start"> 至 <input id="endtime" class="txt" type="text" size="20" value="{{ $coupon->use_end }}" name="use_end"></td>
				</tr>
				<tr class="use_limit_body {{ $coupon->use_limit == 1 ? '' : 'hidden' }}">
					<td width="150" align="right">{{ trans('admin.extend.coupon.use_days') }}</td>
					<td><input class="txt" type="text" size="30" value="" name="use_days"> 天</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.extend.coupon.getway') }}</td>
					<td>
						<label class="radio" for="getway_oneself">
							<input id="getway_oneself" type="radio" name="getway" value="oneself" {{ $coupon->getway == 'oneself' ? 'checked' : '' }}> {{ trans('admin.extend.coupon.getway_oneself') }}
						</label>
						<label class="radio" for="getway_register">
							<input id="getway_register" type="radio" name="getway" value="register" {{ $coupon->getway == 'register' ? 'checked' : '' }}> {{ trans('admin.extend.coupon.getway_register') }}
						</label>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.coupon.remark') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $coupon->remark }}" name="remark"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $(document).on("click", ".use_limit_tab", function(){
                $(".use_limit_body").hide().eq($(this).index()).show();
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
	</script>
@endsection