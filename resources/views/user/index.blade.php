@extends('layouts.user.app')

@section('content')
    <div class="user-info">
        <div class="pic">
            <a href="javascript:;" class="user-face trigger-hover">
                <img id="avatarImg" src="{{ auth()->user()->headimgurl ? uploadImage(auth()->user()->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" width="100" height="100">
                <div class="change-btn hidden"><span>更换头像</span></div>
            </a>
        </div>
        <div class="info">
            <div class="user-stuff">
                <span class="user-username">您好，<strong>{{auth()->user()->username}}</strong></span>
                <span class="user-adjust">
                    <a href="{{ route('user.score.exchange') }}" class="">积分换钱</a>
                    <a href="javascript:;" class="">余额充值</a>
                    <a href="javascript:;" class="">余额提现</a>
                </span>
            </div>
            <div class="user-assets">
                <ul>
                    <li><em>{{auth()->user()->score}} 个</em><span>账户积分</span></li>
                    <li><em>{{auth()->user()->tiyan_money}} 元</em><span>到店体验金</span></li>
                    <li><em>{{auth()->user()->frozen_money}} 元</em><span>冻结余额</span></li>
                    <li><em>{{auth()->user()->user_money}} 元</em><span>可用余额</span></li>
                    <li><em>{{auth()->user()->consume_money}} 元</em><span>消费总额</span></li>
                </ul>
            </div>
            <div class="user-sign">
                <div class="user-sign-box">
                @if ($todaysign)
                    <a href="javascript:;" class="user-sign-btn disabled">今日已签到</a>
                @else
                    <a href="{{ route('user.sign.store') }}" class="user-sign-btn ajaxpost">签到领积分</a>
                @endif
                </div>
                <div class="user-sign-tip">
                    成功签到可<br>随机获得1-10个积分
                </div>
            </div>
        </div>
    </div>
    @if (!auth()->user()->profile)
    <div class="extra-info mtw">
        <a href="{{ route('user.profile.index') }}">首次进入修改个人资料，补充完整送您20积分哦</a>
    </div>
    @endif
    @if (count($index->faqs))
        <div class="user-faq mtw">
            <div class="hd">
                <h3>常见问题</h3>
                <ul>
                    @foreach ($index->faqcategory as $value)
                        <li><a href="#faq_{{ $value->id }}">{{ $value->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="bd">
                @foreach ($index->faqcategory as $value)
                <ul>
                    @foreach ($value->faqs as $val)
                        <li><a href="{{ route('about.faq') }}#faq_{{ $val->catid }}_{{ $val->id }}" target="_blank">{{ $val->title }}</a></li>
                    @endforeach
                </ul>
                @endforeach
            </div>
        </div>
    @endif
    <div class="mtw">
        <div class="tblist order-list">
            <table>
                <tr>
                    <th width="56%" align="center">{{ trans('user.consume.shop') }}</th>
                    <th width="10%" align="center">{{ trans('user.consume.consume_money') }}</th>
                    <th width="10%" align="center">{{ trans('user.consume.order_amount') }}</th>
                    <th width="12%" align="center">{{ trans('user.consume.status') }}</th>
                    <th width="12%" align="center">{{ trans('user.operation') }}</th>
                </tr>
                @if (count($index->consumes))
                    @foreach ($index->consumes as $value)
                        <tr class="tr-bd">
                            <td width="56%" valign="top">
                                @if ($value->shop)
                                    <div class="s-item">
                                        <div class="s-pic">
                                            <a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">
                                                <img src="{{ uploadImage($value->shop->upimage) }}" width="150" height="150">
                                            </a>
                                        </div>
                                        <div class="s-info">
                                            <div class="s-name">
                                                <a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">{{ $value->shop->name }}</a>
                                            </div>
                                            <div class="s-extra">
                                                电话：{{ $value->shop->phone }}
                                            </div>
                                            <div class="s-extra">
                                                地址：{{ $value->shop->address }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    /
                                @endif
                            </td>
                            <td width="10%" align="center">
                                <p><strong>￥{{ sprintf("%.2f",$value->consume_money) }}</strong></p>
                            </td>
                            <td width="10%" align="center">
                                <p><strong>￥{{ sprintf("%.2f",$value->order_amount) }}</strong></p>
                            </td>
                            <td width="12%" align="center">
                                <p class="order-status">{{ trans('user.consume.status_'.$value->pay_status) }}</p>
                                <p><a href="{{ route('user.consume.show', $value->id) }}" title="订单详情" class="openwindow">订单详情</a></p>
                            </td>
                            <td width="12%" align="center">
                                @if ($value->pay_status == 0)
                                    <a href="{{ route('user.consume.pay', $value->id) }}" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
                                @else
                                    @if ($value->shop)
                                        <a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}" class="btn-again">再次消费</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" align="center" class="nodata">暂无数据</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.headimgurl.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $(".user-face").powerWebUpload({
                server: "{{ route('user.profile.face') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".user-faq .hd li:first").addClass("on");
            $(".user-faq .bd ul:first").show();
            $(".user-faq .hd li").click(function(){
                var i = $(this).index();
                $(this).addClass("on").siblings().removeClass("on");
                $(".user-faq .bd ul").eq(i).show().siblings().hide();
            });
        });
    </script>
@endsection