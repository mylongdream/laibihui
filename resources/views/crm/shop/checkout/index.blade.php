@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="{{ route('crm.shop.checkout.index') }}">快速收款</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.shop.checkout.check') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="user_id" value="0">
            <div class="crm-search">
                <dl>
                    <dt>手机号码</dt>
                    <dd><input type="text" name="mobile" class="schtxt" value=""></dd>
                </dl>
                <div class="schbtn"><button class="schuser" name="" type="button">搜索</button></div>
            </div>
            <div class="crm-userinfo">
                <ul>
                    <li>用户名：<span>无</span></li>
                    <li>会员姓名：<span>无</span></li>
                    <li>手机号码：<span>无</span></li>
                    <li>到店体验金：<span>无</span></li>
                    <li>可用积分：<span>无</span></li>
                    <li>可用余额：<span>无</span></li>
                </ul>
            </div>
            <div class="crm-form" style="border-top: 1px solid #dbdbdb;">
                <table>
                    <tr>
                        <td width="150" align="right">消费总额</td>
                        <td><input class="input" type="text" size="50" value="" name="amount" placeholder="" id="amount-input"></td>
                    </tr>
                    <tr>
                        <td align="right">实收金额</td>
                        <td><input class="input" type="text" size="50" value="" id="amount-show" readonly><span class="tdtip mlw"><span id="amount-discount">{{ auth('crm')->user()->shop->discount }}</span> 折</span></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">本次积分</td>
                        <td><input class="input" type="text" size="50" value="" id="score-show" readonly><span class="tdtip mlw">返同等积分</span></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">结 账</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".schuser", function(){
                var self = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('crm.shop.checkout.userinfo') }}",
                    data: {'mobile': $("input[name='mobile']").val()},
                    async:false
                }).success(function(data) {
                    if(data.status == 0){
                        $.jBox.error(data.info, '提示');
                    }else{
                        $(".crm-userinfo").html(data);
                    }
                }).error(function(data) {
                    if (!data) {
                        return true;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            $.jBox.tip(value, 'error');
                            return false;
                        });
                        return false;
                    }
                });
                return false;
            });
            $(document).on("keyup cut paste change", "#amount-input", function(){
                var self = $(this);
                var total = parseInt(self.attr("data-max"), 10) || 100;
                setTimeout(function() {
                    var discount = parseFloat($("#amount-discount").text()) || 0;
                    var value = self.val().replace(/[^\d.]/g,'');
                    value = value.replace(/^\./g,'').replace(/\.{2,}/g,'.');
                    value = value.replace('.','$#$').replace(/\./g,'').replace('$#$','.').replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');
                    self.val(value);
                    value = value ? value : 0;
                    value = parseFloat(value) * discount / 10;
                    value = value.toFixed(2);
                    $("#amount-show").val(value);
                    $("#score-show").val(parseInt(value, 10));
                }, 100);
            });
        });
    </script>
@endsection