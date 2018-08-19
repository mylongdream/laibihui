@extends('layouts.mobile.app')

@section('content')
    <div class="crm-main">
        <div style="font-size: 18px">我的资产</div>
        <div class="crm-count mtw">
            <table>
                <tr>
                    <td width="40%" align="center" class="sub1"><strong>我的提成</strong><span><em>0</em>元</span></td>
                </tr>
            </table>
        </div>
        <div class="mtw" style="font-size: 18px">客户管理</div>
        <div class="crm-count mtw">
            <table>
                <tr>
                    <td width="40%" align="center" class="sub1">
                        <a href="{{ route('crm.checkcustomer.index', ['type' => 'auditing']) }}"><strong>待审客户</strong><span><em>{{ $count->auditingcustomer }}</em>个</span></a>
                    </td>
                    <td width="30%" align="center" class="sub2">
                        <a href="{{ route('crm.checkcustomer.index', ['type' => 'passed']) }}"><strong>通过客户</strong><span><em>{{ $count->passedcustomer }}</em>个</span></a>
                    </td>
                    <td width="30%" align="center" class="sub2">
                        <a href="{{ route('crm.checkcustomer.index', ['type' => 'rejected']) }}"><strong>驳回客户</strong><span><em>{{ $count->rejectedcustomer }}</em>个</span></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection