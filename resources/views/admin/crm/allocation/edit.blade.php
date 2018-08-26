@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.user') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.crm.user.update', $user->uid) }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.crm.user.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.crm.user.index') }}" class="btn">< {{ trans('admin.crm.user.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.user.group') }}</td>
					<td>
						<select name="group" class="select selectgroup">
							<option value="">请选择</option>
							@foreach ($grouplist as $key => $value)
								<option value="{{ $key }}" {!! $user->group == $key ? 'selected="selected"' : '' !!}>{{ $value['name'] }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr class="shopmanage {!! $user->group == "shangjia" ? '' : 'hidden' !!}">
					<td width="150" align="right">{{ trans('admin.crm.user.shop_id') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $user->shop_id }}" name="shop_id"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.user.realname') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $user->realname }}" name="realname"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.user.password') }}</td>
					<td><input class="txt" type="password" size="50" value="" name="password"><span class="tdtip">不填则不修改原密码</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.user.mobile') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $user->mobile }}" name="mobile"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.user.qq') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $user->qq }}" name="qq"></td>
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
        $(function(){
            $(document).on("change", ".selectgroup", function(){
                if($(this).val() == "shangjia"){
                    $(".shopmanage").show();
                }else{
                    $(".shopmanage").hide();
                }
            });
        });
	</script>
@endsection