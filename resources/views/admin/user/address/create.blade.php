@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.address') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.user.address.store') }}">
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.user.address.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.user.address.index') }}" class="btn">< {{ trans('admin.user.address.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="120" align="right">{{ trans('admin.user.address.username') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="username"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.address.area') }}</td>
					<td>
						<div id="address_city">
							<select class="select prov" name="province"></select>
							<select class="select city" name="city"></select>
							<select class="select dist" name="area"></select>
							<select class="select street" name="street"></select>
						</div>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.user.address.address') }}</td>
					<td><textarea class="textarea" name="address" cols="60" rows="2"></textarea></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.user.address.realname') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="realname"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.user.address.mobile') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="mobile"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.user.address.zipcode') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="zipcode"><span class="tdtip">如您不清楚邮递区号可不填</span></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><label class="checkbox" for="default"><input id="default" name="default" value="1" type="checkbox">设置为默认收货地址</label></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#address_city").citySelect({
                url:"{{ route('util.district') }}",
                required:false
            });
        });
	</script>
@endsection