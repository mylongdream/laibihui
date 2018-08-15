@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		@if (auth()->user()->mobile)
			<div class="title"><h3>修改手机号</h3></div>
		@else
			<div class="title"><h3>绑定手机号</h3></div>
		@endif
	</div>
	<div class="mtw">
		<div class="tbedit">
			<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.profile.mobile') }}">
				{!! csrf_field() !!}
				<table>
					<tr>
						<td width="150" align="right">{{ trans('user.profile.mobile') }}</td>
						<td>
							<input id="form-mobile" type="text" name="mobile" class="input">
						</td>
					</tr>
					<tr>
						<td width="150" align="right">验证码</td>
						<td>
							<input id="form-smscode" type="text" name="smscode" class="input verify">
							<input type="hidden" name="mobilerule" value="register">
							<button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
						</td>
					</tr>
					<tr>
						<td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#getsmscode").sms({
                requestUrl:"{{ route('util.smscode') }}",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
	</script>
@endsection