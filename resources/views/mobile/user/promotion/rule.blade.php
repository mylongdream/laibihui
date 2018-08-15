@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
                <div class="wp">
                        <div class="topheader">
                            <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                            <div class="nav">奖励机制</div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-article">
                                    <p>1、当用户通过你所发的推广链接访问本站并成功注册为本站会员奖励积分{{ $setting['promotion_register'] }}分</p>
                                    <p>2、当用户通过你所发的推广链接成功注册成为本站会员并成功办卡消费奖励推荐办卡费5元和额外奖励积分{{ $setting['promotion_register'] }}分</p>
                                    <p>假设：A用户推荐一个B用户，然后 B用户推荐一个C用户，然后C用户推荐同一个D用户，奖励公式为：B用户成功推荐一个C用户等C用户成功持卡消费， 那A用户就额外提成0.5元，B用户就提成5元推荐办卡费。若B用户想得到0.5元提成，必须等到C用户推荐的D用户成功持卡消费</p>
                                    <p>您所获得的收益：一个A用户成功推荐十个B用户办卡并绑卡那A用户就获得了50元办卡推荐费（每个办卡用户提成5元乘以10个用户等于您如果发推荐了10个用户可以提成50元奖励金）
                                        若A发展的办卡用户B成功推荐了10个C用户并绑卡消费，那A就可以额外获得0.5元每推荐一个C用户（每个办卡用户提成0.5元乘以10个用户等于您额外可以获得5元奖励金）
                                        注:本推荐的奖励金可以消费也可以提现到银行卡。
                                    </p>
                                    <p>如果您对本规则还有不清楚的请致电：{{ $setting['site_tel'] }} 或联系在线QQ客服 <a href="http://wpa.qq.com/msgrd?v=3&uin={{ $setting['site_qq'] }}&site=qq&menu=yes" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=1:{{ $setting['site_qq'] }}:1"></a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
@endsection

