@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.appoint') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.appoint.update', $appoint->id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.appoint.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.appoint.index') }}" class="btn">< {{ trans('admin.extend.appoint.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.order_sn') }}</td>
					<td>{{ $appoint->order_sn or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.realname') }}</td>
					<td>{{ $appoint->realname }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.gender') }}</td>
					<td>{{ $appoint->gender ? $appoint->gender == 1 ? '男' : '女' : '保密' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.mobile') }}</td>
					<td>{{ $appoint->mobile or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.address') }}</td>
					<td>{{ $appoint->address or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.qq') }}</td>
					<td>{{ $appoint->qq or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.fromuser') }}</td>
					<td>{{ $appoint->fromuser ? $appoint->fromuser->username : '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.remark') }}</td>
					<td>{{ $appoint->remark or '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.pay_type') }}</td>
					<td>
						@switch($appoint->pay_type)
						@case(1)
						支付宝支付（{{ $appoint->pay_at ? '付款时间：'.$appoint->pay_at->format('Y-m-d H:i') : '未付款' }}）
						@break
						@case(2)
						微信支付（{{ $appoint->pay_at ? '付款时间：'.$appoint->pay_at->format('Y-m-d H:i') : '未付款' }}）
						@break
						@default
						上门办卡
						@endswitch
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.appoint.status') }}</td>
					<td>
						<label class="radio" for="status_0" onclick="$('#appoint_number').hide();$('#appoint_result').hide()">
							<input id="status_0" type="radio" name="status" value="0" {{ $appoint->status == 0 ? 'checked' : '' }}> {{ trans('admin.extend.appoint.status_0') }}
						</label>
						<label class="radio" for="status_1" onclick="$('#appoint_number').show();$('#appoint_result').show()">
							<input id="status_1" type="radio" name="status" value="1" {{ $appoint->status == 1 ? 'checked' : '' }}> {{ trans('admin.extend.appoint.status_1') }}
						</label>
						<label class="radio" for="status_2" onclick="$('#appoint_number').hide();$('#appoint_result').show()">
							<input id="status_2" type="radio" name="status" value="2" {{ $appoint->status == 2 ? 'checked' : '' }}> {{ trans('admin.extend.appoint.status_2') }}
						</label>
					</td>
				</tr>
				<tr id="appoint_number" class="{{ $appoint->status == 1 ? '' : 'hidden' }}">
					<td width="150" align="right">{{ trans('admin.extend.appoint.number') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $appoint->number }}" name="number"></td>
				</tr>
				<tr id="appoint_result" class="{{ $appoint->status == 0 ? 'hidden' : '' }}">
					<td width="150" align="right">{{ trans('admin.extend.appoint.result') }}</td>
					<td><textarea class="textarea" name="result" cols="60" rows="4">{{ $appoint->result }}</textarea></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript">
        $(function() {
            $(document).on("click", ".cancel-tip li", function(){
                if($(this).hasClass("on")){
                    $(this).removeClass("on");
                    $(".cancel-reason").val("");
                }else{
                    $(".cancel-tip li").eq($(this).index()).addClass("on").siblings().removeClass("on");
                    $(".cancel-reason").val($(this).text());
                }
            });
        });
	</script>
@endsection