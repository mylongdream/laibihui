@extends('layouts.crm.app')

@section('content')
    @if (!request()->ajax())
        <div class="crm-main">
            <div class="order-show mtw">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.shop.appoint.update', $appoint->order_sn) }}">
                    <input type="hidden" name="_method" value="PUT">
                    {!! csrf_field() !!}
                    <table>
                        <tr>
                            <th width="150" align="right">订单编号</th>
                            <td>{{ $appoint->order_sn or '/' }}</td>
                        </tr>
                        <tr>
                            <th align="right">姓名</th>
                            <td>{{ $appoint->realname }}</td>
                        </tr>
                        <tr>
                            <th align="right">手机</th>
                            <td>{{ $appoint->mobile or '/' }}</td>
                        </tr>
                        <tr>
                            <th align="right">预约人数</th>
                            <td>{{ $appoint->number or '0' }} 人</td>
                        </tr>
                        <tr>
                            <th align="right">预约时间</th>
                            <td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
                        </tr>
                        <tr>
                            <th align="right">备注信息</th>
                            <td>{{ $appoint->remark or '/' }}</td>
                        </tr>
                        <tr>
                            <th align="right">预约状态</th>
                            <td>
                                <label class="radio" for="status_1">
                                    <input id="status_1" type="radio" name="status" value="1" checked> 已接受
                                </label>
                                <label class="radio" for="status_2">
                                    <input id="status_2" type="radio" name="status" value="2"> 已拒绝
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th align="right">处理原因</th>
                            <td><textarea class="textarea" name="reason" cols="60" rows="4"></textarea></td>
                        </tr>
                        <tr>
                            <th align="right"></th>
                            <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    @else
        <div class="order-show" style="width: 500px;">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.shop.appoint.update', $appoint->order_sn) }}">
                <input type="hidden" name="_method" value="PUT">
                {!! csrf_field() !!}
                <table>
                    <tr>
                        <th width="120" align="right">订单编号</th>
                        <td>{{ $appoint->order_sn or '/' }}</td>
                    </tr>
                    <tr>
                        <th align="right">姓名</th>
                        <td>{{ $appoint->realname }}</td>
                    </tr>
                    <tr>
                        <th align="right">手机</th>
                        <td>{{ $appoint->mobile or '/' }}</td>
                    </tr>
                    <tr>
                        <th align="right">预约人数</th>
                        <td>{{ $appoint->number or '0' }} 人</td>
                    </tr>
                    <tr>
                        <th align="right">预约时间</th>
                        <td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
                    </tr>
                    <tr>
                        <th align="right">备注信息</th>
                        <td>{{ $appoint->remark or '/' }}</td>
                    </tr>
                    <tr>
                        <th align="right">预约状态</th>
                        <td>
                            <label class="radio" for="status_1">
                                <input id="status_1" type="radio" name="status" value="1" checked> 已接受
                            </label>
                            <label class="radio" for="status_2">
                                <input id="status_2" type="radio" name="status" value="2"> 已拒绝
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">处理原因</th>
                        <td><textarea class="textarea" name="reason" cols="60" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <th align="right"></th>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                    </tr>
                </table>
            </form>
        </div>
    @endif
@endsection