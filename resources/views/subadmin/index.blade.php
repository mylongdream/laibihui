@extends('admin.layouts.app')

@section('content')
    <div class="tbedit" style="margin:0">
        <div class="tbhead cl">
            <div class="z">
                <h3>个人信息</h3>
            </div>
        </div>
        <table>
            <tr>
                <td width="150" align="right">{{ trans('admin.profileinfo.username') }}</td>
                <td>{{ auth('admin')->user()->username }}</td>
            </tr>
            <tr>
                <td width="150" align="right">{{ trans('admin.profileinfo.lastlogin') }}</td>
                <td>{{ auth('admin')->user()->lastlogin->format('Y-m-d H:i') }}</td>
            </tr>
            <tr>
                <td width="150" align="right">{{ trans('admin.profileinfo.lastip') }}</td>
                <td>{{ auth('admin')->user()->lastip }}</td>
            </tr>
            <tr>
                <td width="150" align="right">{{ trans('admin.profileinfo.logincount') }}</td>
                <td>{{ auth('admin')->user()->logincount }}</td>
            </tr>
        </table>
    </div>
    <div class="tbedit">
        <div class="tbhead cl">
            <div class="z">
                <h3>系统信息</h3>
            </div>
        </div>
        <table>
            <tr>
                <td width="150" align="right">{{ trans('admin.system.server.os') }}</td>
                <td>{{ $systeminfo['os'] }}</td>
            </tr>
            <tr>
                <td align="right">{{ trans('admin.system.server.server_domain') }}</td>
                <td>{{ $systeminfo['server_domain'] }}</td>
            </tr>
            <tr>
                <td align="right">{{ trans('admin.system.server.web_server') }}</td>
                <td>{{ $systeminfo['web_server'] }}</td>
            </tr>
            <tr>
                <td align="right">{{ trans('admin.system.server.php_ver') }}</td>
                <td>{{ $systeminfo['php_ver'] }}</td>
            </tr>
            <tr>
                <td align="right">{{ trans('admin.system.server.mysql_ver') }}</td>
                <td>{{ $systeminfo['mysql_ver'] }}</td>
            </tr>
            <tr>
                <td align="right">{{ trans('admin.system.server.max_filesize') }}</td>
                <td>{{ $systeminfo['max_filesize'] }}</td>
            </tr>
            <tr>
                <td align="right">{{ trans('admin.system.server.mysql_size') }}</td>
                <td>{{ $systeminfo['mysql_size'] }}</td>
            </tr>
        </table>
    </div>
@endsection