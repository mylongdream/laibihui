@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>新增客户</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.kefu.customer.store') }}">
                    {!! csrf_field() !!}
                    <div class="subtitle">必填信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right">经营类目</td>
                            <td>
                                <select class="select" name="catid">
                                    <option value="">请选择</option>
                                    @foreach ($categorylist as $scategory)
                                        <option value="{{ $scategory->id }}">{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td><input class="input" type="text" size="50" value="" name="name" placeholder=""></td>
                        </tr>
                        <tr>
                            <td align="right">商户地址</td>
                            <td><input class="input" type="text" size="50" value="" name="address" placeholder=""></td>
                        </tr>
                        <tr>
                            <td align="right">联系电话</td>
                            <td><input class="input" type="text" size="50" value="" name="phone" placeholder=""></td>
                        </tr>
                        <tr>
                            <td align="right">跟进情况</td>
                            <td>
                                <label class="radio" for="status_0"><input value="0" name="status" id="status_0" type="radio" checked >初步接触</label>
                                <label class="radio" for="status_1"><input value="1" name="status" id="status_1" type="radio">有意向</label>
                                <label class="radio" for="status_2"><input value="2" name="status" id="status_2" type="radio" >开发中</label>
                                <label class="radio" for="status_3"><input value="3" name="status" id="status_3" type="radio" >已成功</label>
                                <label class="radio" for="status_4"><input value="4" name="status" id="status_4" type="radio" >已失败</label>
                            </td>
                        </tr>
                    </table>
                    <div class="subtitle">选填信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right" valign="top">备注其它</td>
                            <td><textarea class="textarea" name="remark" cols="60" rows="4"></textarea></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection