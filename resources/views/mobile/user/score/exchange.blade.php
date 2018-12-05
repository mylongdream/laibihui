@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.score.exchange') }}</div>
                </div>
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('mobile.user.score.exchange') }}">
                    {!! csrf_field() !!}
                    <input id="score_exchange" value="{{ $setting['score_exchange'] }}" type="hidden" />
                    <div class="weui-panel" style="margin: 0">
                        <div class="weui-msg">
                            <div class="weui-msg__text-area">
                                <h2 class="weui-msg__title">当前<span style="font-size: 36px;margin: 0 10px">{{ auth()->user()->score }}</span>个积分</h2>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells pay-money">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">兑换可用余额</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input numeric" type="number" name="amount" value="1" id="amount-input" data-max="{{ auth()->user()->score >= $setting['score_exchange'] ? floor(auth()->user()->score / $setting['score_exchange']) : 1 }}">
                            </div>
                            <div class="weui-cell__ft">元</div>
                        </div>
                    </div>
                    <div class="weui-cells order-submit">
                        <div class="order-account">
                            所需积分<span id="needscore">{{ $setting['score_exchange'] }}</span> 个
                        </div>
                        <div class="order-btn">
                            @if (auth()->user()->score >= $setting['score_exchange'])
                                <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">兑 换</button>
                            @else
                                <button name="applybtn" type="button" class="weui-btn weui-btn_default">无法兑换</button>
                            @endif
                        </div>
                        <div class="order-remark">
                            注：<span>{{ $setting['score_exchange'] }}个积分可兑换1元可用余额</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on("change", "#amount-input", function(){
                var value = $(this).val();
                var score_exchange = $('#score_exchange').val();
                $("#needscore").text(value * score_exchange);
            })
        });
    </script>
@endsection