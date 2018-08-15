@extends('layouts.common.app')

@section('content')
    <div class="wp">
        <div class="buy-body">
            <p align="center"><img src="{{ asset('static/image/brand/card1.jpg') }}" alt="" width=""></p>
            @if (!(auth()->check() && auth()->user()->card))
            <div class="buy-card">
                <div class="buy-tip">
                    请认真填写以下信息，我们会第一时间与您电话联系并为你办卡
                </div>
                <div class="buy-form">
                    <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('brand.card.appoint') }}">
                        {!! csrf_field() !!}
                        <table>
                            <tr>
                                <td align="right"><span class="required">*</span>您的姓名</td>
                                <td><input class="input" type="text" size="50" value="" name="realname"></td>
                                <td align="right"><span class="required">*</span>您的性别</td>
                                <td>
                                    <label class="radio" for="gender_1"><input id="gender_1" type="radio" name="gender" value="1" checked> 男</label>
                                    <label class="radio" for="gender_2"><input id="gender_2" type="radio" name="gender" value="2"> 女</label>
                                </td>
                            </tr>
                            @guest
                            <tr>
                                <td align="right"><span class="required">*</span>手机号码</td>
                                <td><input class="input" type="text" size="50" value="" name="mobile"></td>
                                <td align="right"><span class="required">*</span>短信验证码</td>
                                <td>
                                    <input id="form-smscode" type="text" name="smscode" class="input verify">
                                    <input type="hidden" name="mobilerule" value="">
                                    <button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
                                </td>
                            </tr>
                            @endguest
                            <tr>
                                <td align="right"><span class="required">*</span>联系地址</td>
                                <td><input class="input" type="text" size="50" value="" name="address"></td>
                                <td align="right">联系QQ</td>
                                <td><input class="input" type="text" size="50" value="" name="qq"></td>
                            </tr>
                            <tr>
                                <td align="right">备注信息</td>
                                <td colspan="3"><input class="input remark" type="text" size="50" value="" name="remark">
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="top"><span class="required">*</span>办卡方式</td>
                                <td colspan="3">
                                    <p><label class="radio" for="pay_0"><input id="pay_0" type="radio" name="pay_type" value="0" checked>  上门办卡 / 10元（<span class="text-red">卡10元 + 业务员会与您联系并约时间上门办卡</span>）（仅限杭州地区用户）</label></p>
                                    <p><label class="radio" for="pay_1"><input id="pay_1" type="radio" name="pay_type" value="1">  支付宝支付 / 20元（<span class="text-red">卡10元 + 邮递费10元 = 20元</span>）</label></p>
                                    <p><label class="radio" for="pay_2"><input id="pay_2" type="radio" name="pay_type" value="2">  微信支付 / 20元（<span class="text-red">卡10元 + 邮递费10元 = 20元</span>）</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="4">
                                    <button value="true" name="savesubmit" type="submit" class="button">立即办卡</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            @endif
            <p align="center"><img src="{{ asset('static/image/brand/card2.jpg') }}" alt="" width=""></p>
            <p align="center"><img src="{{ asset('static/image/brand/card4.jpg') }}" alt="" width=""></p>
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