@extends('layouts.crm.app')

@section('content')
    @if (!request()->ajax())
        <div class="crm-tabnav">
            <ul>
                <li class="on"><a href="{{ route('crm.ordermeal.index') }}">自助点餐明细</a></li>
                <li><a href="{{ route('crm.ordermeal.create') }}">我要点餐</a></li>
            </ul>
        </div>
        <div class="crm-main">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.ordermeal.update', $order->order_sn) }}">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                <div class="order-show">
                    <table>
                        <tr>
                            <th width="20%" align="right">订单编号</th>
                            <td>{{ $order->order_sn ? $order->order_sn : '/' }}</td>
                        </tr>
                        <tr>
                            <th align="right">用户是否绑卡</th>
                            <td>{{ $order->bindcard ? '是' : '否' }}</td>
                        </tr>
                        <tr>
                            <th align="right">所点菜品</th>
                            <td>
                                @foreach ($order->records as $val)
                                    <div class="s-item">
                                        <div class="s-pic">
                                            <img src="{{ uploadImage($val->upimage) }}" width="150" height="150">
                                        </div>
                                        <div class="s-info">
                                            <div class="s-name">
                                                {{ $val->name }}
                                            </div>
                                            <div class="s-extra">
                                                价格：{{ $val->price }}
                                            </div>
                                            <div class="s-extra">
                                                数量：{{ $val->number }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                        @if ($order->remark)
                            <tr>
                                <th align="right">顾客要求</th>
                                <td>{{ $order->remark ? $order->remark : '/' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="mtw">
                    <table width="100%">
                        <tr>
                            <td width="33%">消费总金额：{{ $order->consume_money or '0' }}元</td>
                            <td width="33%">优惠金额：{{ $order->consume_money - $order->order_amount }}元</td>
                            <td width="34%">实付金额：{{ $order->order_amount or '0' }}元</td>
                        </tr>
                    </table>
                </div>
                <div class="order-show mtw">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <label class="radio" for="status_1"><input value="1" name="status" id="status_1" type="radio" checked>已确认</label>
                                <label class="radio" for="status_2"><input value="2" name="status" id="status_2" type="radio" >已取消</label>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    @else
        <div style="width: 650px;">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.ordermeal.update', $order->order_sn) }}">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                <div class="order-show">
                    <table>
                        <tr>
                            <th width="150" align="right">订单编号</th>
                            <td>{{ $order->order_sn ? $order->order_sn : '/' }}</td>
                        </tr>
                        <tr>
                            <th align="right">用户是否绑卡</th>
                            <td>{{ $order->bindcard ? '是' : '否' }}</td>
                        </tr>
                        <tr>
                            <th align="right">所点菜品</th>
                            <td>
                                @foreach ($order->records as $val)
                                    <div class="s-item">
                                        <div class="s-pic">
                                            <img src="{{ uploadImage($val->upimage) }}" width="150" height="150">
                                        </div>
                                        <div class="s-info">
                                            <div class="s-name">
                                                {{ $val->name }}
                                            </div>
                                            <div class="s-extra">
                                                价格：{{ $val->price }}
                                            </div>
                                            <div class="s-extra">
                                                数量：{{ $val->number }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                        @if ($order->remark)
                            <tr>
                                <th align="right">顾客要求</th>
                                <td>{{ $order->remark ? $order->remark : '/' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="order-show mtw">
                    <table width="100%">
                        <tr>
                            <td width="33%">消费总金额：{{ $order->consume_money or '0' }}元</td>
                            <td width="33%">优惠金额：{{ $order->consume_money - $order->order_amount }}元</td>
                            <td width="34%">实付金额：{{ $order->order_amount or '0' }}元</td>
                        </tr>
                    </table>
                </div>
                <div class="order-show mtw">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <label class="radio" for="status_1"><input value="1" name="status" id="status_1" type="radio" checked>已确认</label>
                                <label class="radio" for="status_2"><input value="2" name="status" id="status_2" type="radio" >已取消</label>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    @endif
@endsection