@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.score') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('user.score.index') }}"><span>{{ trans('user.score.list') }}</span></a></li>
			<li><a href="{{ route('user.score.exchange') }}"><span>{{ trans('user.score.exchange') }}</span></a></li>
			<li class="on"><a href="{{ route('user.score.transfer') }}"><span>{{ trans('user.score.transfer') }}</span></a></li>
		</ul>
	</div>
	<div class="tbedit mtw">
		<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.score.transfer') }}">
			{!! csrf_field() !!}
			<table>
				<tr>
					<td width="150" align="right">当前积分</td>
					<td>{{ auth()->user()->score }} 个</td>
				</tr>
				<tr>
					<td align="right">转让积分</td>
					<td>
						<div class="choose-amount">
							<span class="cut_num"></span>
							<input class="key_num" type="text" value="1" name="amount" size="6" maxlength="6" data-max="{{ auth()->user()->score > 0 ? auth()->user()->score : 1 }}">
							<span class="add_num"></span>
						</div>
						<div class="choose-tip">个</div>
					</td>
				</tr>
				<tr>
					<td align="right">对方账户</td>
					<td><input class="input" type="text" size="50" value="" name="account" placeholder="用户名/手机号码"></td>
				</tr>
				<tr>
					<td align="right">转让说明</td>
					<td><input class="input" type="text" size="50" value="" name="message"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td>
                        @if (auth()->user()->score > 0)
                            <button value="true" name="savesubmit" type="submit" class="button">转 让</button>
                        @else
                            <button value="false" name="savesubmit" type="button" class="button disabled">无法转让</button>
                        @endif
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td>注：<span>请确保对方账户正确后再转让</span></td>
				</tr>
			</table>
		</form>
	</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on("change", ".choose-amount .key_num", function(){
                var value = $(this).val();
                $("#needscore").text(value * 1000);
            })
        });
    </script>
@endsection