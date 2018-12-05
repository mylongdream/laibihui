@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.score') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('user.score.index') }}"><span>{{ trans('user.score.list') }}</span></a></li>
			<li class="on"><a href="{{ route('user.score.exchange') }}"><span>{{ trans('user.score.exchange') }}</span></a></li>
			<li><a href="{{ route('user.score.transfer') }}"><span>{{ trans('user.score.transfer') }}</span></a></li>
		</ul>
	</div>
	<div class="tbedit mtw">
		<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.score.exchange') }}">
			{!! csrf_field() !!}
			<input id="score_exchange" value="{{ $setting['score_exchange'] }}" type="hidden" />
			<table>
				<tr>
					<td width="150" align="right">当前积分</td>
					<td>{{ auth()->user()->score }} 个</td>
				</tr>
				<tr>
					<td align="right">兑换可用余额</td>
					<td>
						<div class="choose-amount">
							<span class="cut_num"></span>
							<input class="key_num" type="text" value="1" name="amount" size="6" maxlength="6" data-max="{{ auth()->user()->score >= $setting['score_exchange'] ? floor(auth()->user()->score / $setting['score_exchange']) : 1 }}">
							<span class="add_num"></span>
						</div>
						<div class="choose-tip">元</div>
					</td>
				</tr>
				<tr>
					<td align="right">所需积分</td>
					<td class="text-red">
						所需积分<span id="needscore">{{ $setting['score_exchange'] }}</span> 个
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td>
                        @if (auth()->user()->score >= $setting['score_exchange'])
                            <button value="true" name="savesubmit" type="submit" class="button">兑 换</button>
                        @else
                            <button value="false" name="savesubmit" type="button" class="button disabled">无法兑换</button>
                        @endif
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td>注：<span>{{ $setting['score_exchange'] }}个积分可兑换1元可用余额</span></td>
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
                var score_exchange = $('#score_exchange').val();
                $("#needscore").text(value * score_exchange);
            })
        });
    </script>
@endsection