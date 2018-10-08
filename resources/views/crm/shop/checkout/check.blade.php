@extends('layouts.crm.app')

@section('content')
    <div class="crm-checkout" style="width:640px;">
        <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.shop.checkout.pay') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
            <input type="hidden" name="amount" value="{{ request('amount') }}">
            <input type="hidden" name="paytype" value="cash">
            <div class="receivable">应收金额：<strong id="receivable_money">{{ request('amount') }}</strong> 元</div>
            @if (0)
            <div class="crm-form">
                <table>
                    <tr>
                        <td align="right" width="100"><span class="checkbox" id="check_usemoney"><i></i>可用余额</span></td>
                        <td>
                            <input class="input" type="text" size="20" value="0" name="usemoney" placeholder="" style="width:120px;" disabled="disabled"> 元
                            <span class="tdtip mlw">当前可用余额为 <span id="user_money">{{ $userinfo->user_money }}</span> 元</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="stillneed">还需支付：<strong id="stillneed_money">{{ request('account') }}</strong> 元</div>
            @endif
            <div class="crm-form">
                <table>
                    <tr>
                        <td align="right">支付方式</td>
                        <td>
                            <div class="payment">
                                <ul>
                                    <li data-type="cash" class="on">现金支付</li>
                                    <li data-type="wechat">微信支付</li>
                                    <li data-type="alipay">支付宝支付</li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="cash-box">
                        <td align="right" width="100">实收金额</td>
                        <td><input class="input" type="text" size="20" value="" name="money" placeholder="" style="width:120px;"> 元</td>
                    </tr>
                    <tr class="paycode-box hidden">
                        <td align="right" width="100">付款码</td>
                        <td><input class="input" type="text" size="50" value="" name="paycode" placeholder=""></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">备注信息</td>
                        <td><textarea class="textarea" name="remark" cols="60" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".payment li", function(){
                var self = $(this);
                self.addClass("on").siblings().removeClass("on");
                $("input[name='paytype']").val(self.data('type'));
                if(self.data('type') === 'cash'){
                    $('.cash-box').show();
                    $('.paycode-box').hide();
                }else{
                    $('.cash-box').hide();
                    $('.paycode-box').show();
                }
            });
            $(document).off("click","#check_usemoney").on("click", "#check_usemoney", function(){
                var self = $(this);
                if(self.hasClass("selected")){
                    self.removeClass("selected");
                    $("input[name='usemoney']").val(0).attr("disabled","disabled").trigger('change');
                }else{
                    self.addClass("selected");
                    $("input[name='usemoney']").removeAttr("disabled");
                }
            });
            $(document).on("keyup cut paste change", "input[name='usemoney']", function(){
                var self = $(this);
                var receivable_money = parseFloat($('#receivable_money').text()) || 0;
                var user_money = parseFloat($('#user_money').text()) || 0;
                var total = user_money > receivable_money ? receivable_money : user_money;
                setTimeout(function() {
                    var value = self.val().replace(/[^\d.]/g,'');
                    value = value.replace(/^\./g,'').replace(/\.{2,}/g,'.');
                    value = value.replace('.','$#$').replace(/\./g,'').replace('$#$','.').replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');
                    value = value ? (value > total ? total : value) : 0;
                    self.val(value);
                    $("#stillneed_money").text(receivable_money - value);
                }, 100);
            });
        });
    </script>
@endsection