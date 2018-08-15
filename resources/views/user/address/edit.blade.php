@extends('layouts.user.app')

@section('content')
	@if (!request()->ajax())
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.address') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('user.address.index') }}"><span>{{ trans('user.address.list') }}</span></a></li>
			<li class="on"><a href="{{ route('user.address.edit',$address->id) }}"><span>{{ trans('user.address.edit') }}</span></a></li>
		</ul>
	</div>
	<div class="mtw">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('user.address.edit') }}</h3></div>
		</div>
		<div class="tbedit">
			<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.address.update',$address->id) }}">
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
				<table>
					<tr>
						<td width="150" align="right">{{ trans('user.address.area') }}</td>
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
						<td align="right">{{ trans('user.address.address') }}</td>
						<td><textarea class="textarea" name="address" cols="60" rows="2">{{ $address->address }}</textarea></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.address.realname') }}</td>
						<td><input class="input" type="text" size="50" value="{{ $address->realname }}" name="realname"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.address.mobile') }}</td>
						<td><input class="input" type="text" size="50" value="{{ $address->mobile }}" name="mobile"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.address.zipcode') }}</td>
						<td><input class="input" type="text" size="50" value="{{ $address->zipcode }}" name="zipcode"><span class="tdtip">如您不清楚邮递区号可不填</span></td>
					</tr>
					<tr>
						<td align="right"></td>
						<td><label class="checkbox" for="default"><input id="default" name="default" value="1" type="checkbox" {{ auth()->user()->address_id == $address->id ? 'checked' : '' }}>设置为默认收货地址</label></td>
					</tr>
					<tr>
						<td align="right"></td>
						<td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
    @else
        <div class="pop-form">
            <form class="addressform" enctype="multipart/form-data" method="post" action="{{ route('user.address.update',$address->id) }}">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                <table>
                    <tr>
                        <td align="right"><span class="required">*</span>{{ trans('user.address.area') }}：</td>
                        <td>
                            <div id="address_city">
                                <select class="select prov" name="province" style="width: 82px"></select>
                                <select class="select city" name="city" style="width: 82px"></select>
                                <select class="select dist" name="area" style="width: 82px"></select>
                                <select class="select street" name="street" style="width: 82px"></select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="required">*</span>{{ trans('user.address.address') }}：</td>
                        <td><textarea class="textarea" name="address" cols="60" rows="2">{{ $address->address }}</textarea></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="required">*</span>{{ trans('user.address.realname') }}：</td>
                        <td><input class="input" type="text" size="50" value="{{ $address->realname }}" name="realname"></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="required">*</span>{{ trans('user.address.mobile') }}：</td>
                        <td><input class="input" type="text" size="50" value="{{ $address->mobile }}" name="mobile"></td>
                    </tr>
                    <tr>
                        <td align="right">{{ trans('user.address.zipcode') }}：</td>
                        <td><input class="input" type="text" size="50" value="{{ $address->zipcode }}" name="zipcode" placeholder="如您不清楚邮递区号可不填"></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><label class="checkbox" for="default"><input id="default" name="default" value="1" type="checkbox" {{ auth()->user()->address_id == $address->id ? 'checked' : '' }}>设置为默认收货地址</label></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                    </tr>
                </table>
            </form>
        </div>
    @endif
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#address_city").citySelect({
                url:"{{ route('util.district') }}",
                required:false,
                prov:"{{ $address->province }}",
                city:"{{ $address->city }}",
                dist:"{{ $address->area }}",
                street:"{{ $address->street }}"
            });
        });
	</script>
@endsection