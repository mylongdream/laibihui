@extends('layouts.common.simple')

@section('content')
    @if (!request()->ajax())
        <div class="shop-body">
            @include('brand.shop.header')
            <div class="wp">
                <div class="shop-appoint mtm">
                    <div class="hd">
                        <span>店铺预约</span>
                    </div>
                    <div class="bd">
                    <form id="appointForm" class="ajaxform" action="{{ route('brand.shop.appoint', $shop->id) }}" method="post">
                        {!! csrf_field() !!}
                        <table class="ipt">
                            <tr>
                                <td align="right"><span class="required">*</span>顾客姓名：</td>
                                <td><input type="text" name="realname" class="input" placeholder=""></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="required">*</span>预约人数：</td>
                                <td>
                                    <div class="choose-amount">
                                        <span class="cut_num"></span>
                                        <input class="key_num" type="text" value="1" name="number" size="4" maxlength="4" data-max="100">
                                        <span class="add_num"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span class="required">*</span>手机号码：</td>
                                <td><input type="text" name="mobile" class="input" placeholder=""></td>
                            </tr>
                            <tr>
                                <td align="right"><span class="required">*</span>预约时间：</td>
                                <td><input type="text" name="appoint_at" class="input" placeholder="" readonly id="datetime" onclick="laydate({min: laydate.now(),istime: true,format:'YYYY-MM-DD hh:mm'})"></td>
                            </tr>
                            <tr>
                                <td align="right">备注要求：</td>
                                <td><textarea class="textarea" data-maxlength="300" name="remark" placeholder="其他要求在此输入说明"></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button name="appointbtn" type="submit" class="button">立即预约</button></td>
                            </tr>
                        </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="pop-form">
            <form id="appointForm" class="ajaxform" action="{{ route('brand.shop.appoint', $shop->id) }}" method="post">
                {!! csrf_field() !!}
                <table class="ipt">
                    <tr>
                        <td align="right"><span class="required">*</span>顾客姓名：</td>
                        <td><input type="text" name="realname" class="input" placeholder=""></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="required">*</span>预约人数：</td>
                        <td>
                            <div class="choose-amount">
                                <span class="cut_num"></span>
                                <input class="key_num" type="text" value="1" name="number" size="4" maxlength="4" data-max="100">
                                <span class="add_num"></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><span class="required">*</span>手机号码：</td>
                        <td><input type="text" name="mobile" class="input" placeholder=""></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="required">*</span>预约时间：</td>
                        <td><input type="text" name="appoint_at" class="input" placeholder="" readonly id="datetime" onclick="laydate({min: laydate.now(),istime: true,format:'YYYY-MM-DD hh:mm'})"></td>
                    </tr>
                    <tr>
                        <td align="right">备注要求：</td>
                        <td><textarea class="textarea" data-maxlength="300" name="remark" placeholder="其他要求在此输入说明"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button name="appointbtn" type="submit" class="button">立即预约</button></td>
                    </tr>
                </table>
            </form>
        </div>
    @endif
@endsection


