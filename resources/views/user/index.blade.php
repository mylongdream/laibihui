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
    @if (count($index->announces))
        <div class="announce-list mtw">
            <div class="hd">
                <div class="z"><h3>系统公告</h3></div>
                <div class="y"><a href="{{ route('announce.index') }}" target="_blank">查看更多</a></div>
            </div>
            <div class="bd">
                <ul>
                    @foreach ($index->announces as $value)
                        <li>
                            <a href="{{ route('announce.show', ['id'=>$value->id]) }}" target="_blank">
                                <strong>{{ $value->title }}</strong><span>{{ $value->created_at->format('Y-m-d H:i') }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="mtw">
        <div class="tblist order-list">
            <table>
                <tr>
                    <th align="left">{{ trans('user.consume.shop') }}</th>
                    <th align="center">{{ trans('user.consume.money') }}</th>
                    <th align="center">{{ trans('user.consume.status') }}</th>
                    <th align="center" width="120">{{ trans('user.operation') }}</th>
                </tr>
                @if (count($index->consumes))
                    @foreach ($index->consumes as $value)
                        <tr class="tr-bd">
                            <td width="66%" valign="top">
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
                            <td width="10%" align="center">{{ $value->money }} 元</td>
                            <td width="12%" align="center">
                                <p class="order-status">{{ trans('user.consume.status_'.$value->ifpay) }}</p>
                                <p><a href="{{ route('user.consume.show', $value->id) }}" title="订单详情" class="openwindow">订单详情</a></p>
                            </td>
                            <td width="12%" align="center">
                                @if ($value->ifpay == 0)
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
    @if (count($index->faqs))
    <div class="user-faq mtw">
        <div class="hd">
            <h3>常见问题</h3>
        </div>
        <div class="bd">
            <ul>
                @foreach ($index->faqs as $value)
                    <li><a href="{{ route('about.faq') }}#faq_{{ $value->catid }}_{{ $value->id }}" target="_blank">{{ $value->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
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
        });
    </script>
@endsection