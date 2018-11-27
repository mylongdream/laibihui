@extends('layouts.mobile.app')

@section('style')
<style>
    .grantsell_list{background:#fff;}
    .grantsell_list table{border-spacing:0;border-collapse:collapse;width:100%;font-size:14px;}
    .grantsell_list table th{height:30px;padding:5px 6px;border:1px solid #e2e2e2;font-weight:bold;text-align: center}
    .grantsell_list table td{height:30px;padding:5px 6px;border:1px solid #e2e2e2;word-break:break-all;text-align: center;}
    #cardnum_input{padding: 4px 6px;border: 1px solid #ccc;box-sizing: border-box;height: 2em;}
</style>
@endsection

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="topheader">
                            <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                            <div class="nav">授权办卡</div>
                        </div>
                        <div class="grantsell_list">
                            <table>
                                <tr>
                                    <th width="120">姓名</th>
                                    <th width="120">总售卡数</th>
                                    <th width="120">剩余卡数</th>
                                    <th width="250">操作</th>
                                </tr>
                                @foreach ($list as $value)
                                    <tr>
                                        <td>{{ $value->realname }}</td>
                                        <td>{{ $value->sellnum }}</td>
                                        <td>{{ $value->allotnum - $value->sellnum }}</td>
                                        <td>
                                            <a href="{{ route('mobile.crm.tuiguang.grantsell.patch', ['id' => $value->id]) }}" class="promptbutton">补卡</a>
                                            <a href="{{ route('mobile.crm.tuiguang.grantsell.cancel', ['id' => $value->id]) }}" class="ajaxbutton confirmbtn mlm" data-method="post" title="取消授权">取消授权</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        {!! $list->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="javascript:;" class="weui-tabbar__item tabbar-btn" id="getuserid">
                <span>扫一扫授权办卡</span>
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $(document).on("click", ".promptbutton", function(){
                var self = $(this);
                var content = '<input type="text" name="cardnum" class="weui-input" id="cardnum_input" />';
                var dialogDom = weui.dialog({
                    title: '输入补卡数量',
                    content: content,
                    isAndroid: false,
                    buttons: [{
                        label: '取消',
                        type: 'default',
                        onClick: function () { }
                    }, {
                        label: '确定',
                        type: 'primary',
                        onClick: function () {
                            var loading = weui.loading('loading');
                            $.ajax({
                                type:'POST',
                                url:self.attr("href"),
                                data:{'cardnum': $("#cardnum_input").val()}
                            }).success(function(data) {
                                loading.hide();
                                if(data.status == 1){
                                    if (data.info) {
                                        weui.toast(data.info, {
                                            duration: 3000,
                                            className: 'toast-success',
                                            callback: function(){
                                                if(data.url){
                                                    window.location.href = data.url;
                                                } else {
                                                    window.location.reload();
                                                }
                                            }
                                        });
                                    } else {
                                        if (data.url) {
                                            window.location.href = data.url;
                                        } else {
                                            location.reload();
                                        }
                                    }
                                } else {
                                    weui.alert(data.info, {
                                        isAndroid: false
                                    });
                                }
                            }).error(function() {
                                loading.hide();
                                if (!data) {
                                    return true;
                                } else {
                                    message = $.parseJSON(data.responseText);
                                    $.each(message.errors, function (key, value) {
                                        weui.alert(value, {
                                            isAndroid: false
                                        });
                                        return false;
                                    });
                                    return false;
                                }
                            });
                            return false;
                        }
                    }]
                });
                return false;
            });
        });
    </script>
    @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        <script type="text/javascript">
            wx.config({!! app('wechat.official_account')->jssdk->buildConfig(array('scanQRCode'), false) !!});
            $(function(){
                $(document).on("click", "#getuserid", function(){
                    wx.scanQRCode({
                        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                        scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
                        success: function (res) {            // 扫码成功，跳转到二维码指定页面（res.resultStr为扫码返回的结果）
                            location.href = res.resultStr;
                        }
                    });
                });
            });
        </script>
    @endif
    @if (strpos(request()->userAgent(), 'AlipayClient') !== false)
        <script src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $(document).on("click", "#getuserid", function(){
                    ap.scan({
                        type: 'qr'
                    }, function(res){            // 扫码成功，跳转到二维码指定页面（res.resultStr为扫码返回的结果）
                        location.href = res.code;
                    });
                });
            });
        </script>
    @endif
@endsection