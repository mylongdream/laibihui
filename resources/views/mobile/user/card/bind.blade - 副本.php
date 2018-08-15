@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.card.bind') }}</h3></div>
	</div>
	<div class="mtw">
		@if ($card)
            <div class="bindcard">恭喜您已绑卡，卡号为：{{ $card->number }}</div>
		@else
            <div class="tbedit">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.card.bind') }}">
                    {!! csrf_field() !!}
                    <table>
                        <tr>
                            <td width="120" align="right">{{ trans('user.card.bind.number') }}</td>
                            <td><input class="input numeric" type="text" size="50" value="" name="number"></td>
                        </tr>
                        <tr>
                            <td width="120" align="right">{{ trans('user.card.bind.password') }}</td>
                            <td><input class="input" type="password" size="50" value="" name="password"></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><a href="{{ route('brand.card.appoint') }}" target="_blank" class="text-red">我还没有卡，立即前去办卡</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        @endif
	</div>
@endsection