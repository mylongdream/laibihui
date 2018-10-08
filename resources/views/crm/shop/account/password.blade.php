@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li><a href="{{ route('crm.account.index') }}">个人资料</a></li>
            <li class="on"><a href="{{ route('crm.account.password') }}">密码安全</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>修改密码</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.account.password') }}">
                    {!! csrf_field() !!}
                    <table>
                        <tr>
                            <td width="150" align="right">旧密码</td>
                            <td><input class="input" type="password" size="50" value="" name="oldpassword" placeholder="请输入旧密码"></td>
                        </tr>
                        <tr>
                            <td align="right">新密码</td>
                            <td><input class="input" type="password" size="50" value="" name="newpassword" placeholder="请输入新密码"></td>
                        </tr>
                        <tr>
                            <td align="right">确认新密码</td>
                            <td><input class="input" type="password" size="50" value="" name="newpassword_confirmation" placeholder="请确认新输入密码"></td>
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