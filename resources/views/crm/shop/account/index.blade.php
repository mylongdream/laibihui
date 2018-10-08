@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="{{ route('crm.shop.account.index') }}">个人资料</a></li>
            <li><a href="{{ route('crm.shop.account.password') }}">密码安全</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>个人资料</h4>
            </div>
            <div class="bd crm-form">
                <table>
                    <tr>
                        <td width="150" align="right"><label>所属部门</label></td>
                        <td>{{config('crm.group.'.auth('crm')->user()->group->module.'.name')}}</td>
                    </tr>
                    <tr>
                        <td align="right"><label>真实姓名</label></td>
                        <td>{{auth('crm')->user()->realname ? auth('crm')->user()->realname : '/'}}</td>
                    </tr>
                    <tr>
                        <td align="right"><label>手机号码</label></td>
                        <td>{{auth('crm')->user()->mobile}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection