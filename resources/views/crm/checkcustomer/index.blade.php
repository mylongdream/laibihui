@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.checkcustomer.index') }}">
            <div class="crm-search">
                <dl>
                    <dd>
                        <select class="schselect" name="type" onchange='this.form.submit()'>
                            <option value="passed" {!! request('type') == 'passed' ? 'selected="selected"' : '' !!}>通过客户</option>
                            <option value="auditing" {!! request('type') == 'auditing' ? 'selected="selected"' : '' !!}>待审客户</option>
                            <option value="rejected" {!! request('type') == 'rejected' ? 'selected="selected"' : '' !!}>驳回客户</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>商户名称</dt>
                    <dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            @if (request('type') == 'passed')
                <table>
                    <tr>
                        <th align="left" width="180">商户名称</th>
                        <th align="left">商户地址</th>
                        <th align="left" width="120">联系方式</th>
                        <th align="left" width="120">提交业务员</th>
                        <th align="left" width="120">通过时间</th>
                    </tr>
                    @foreach ($customers as $value)
                        <tr>
                            <td><a href="{{ route('crm.checkcustomer.show',$value->id) }}" class="openwindow" title="商户详情">{{ $value->name }}</a></td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>{{ $value->user ? $value->user->realname : '/' }}</td>
                            <td>{{ $value->check_at ? $value->check_at->format('Y-m-d H:i') : '/' }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
            @if (request('type') == 'auditing')
                <table>
                    <tr>
                        <th align="left" width="180">商户名称</th>
                        <th align="left">商户地址</th>
                        <th align="left" width="120">联系方式</th>
                        <th align="left" width="120">提交业务员</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    @foreach ($customers as $value)
                        <tr>
                            <td><a href="{{ route('crm.checkcustomer.show',$value->id) }}" class="openwindow" title="商户详情">{{ $value->name }}</a></td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>{{ $value->user ? $value->user->realname : '/' }}</td>
                            <td>
                                <a href="{{ route('crm.checkcustomer.check',$value->id) }}" class="">点击审核</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
            @if (request('type') == 'rejected')
                <table>
                    <tr>
                        <th align="left" width="180">商户名称</th>
                        <th align="left">商户地址</th>
                        <th align="left" width="120">联系方式</th>
                        <th align="left" width="120">提交业务员</th>
                        <th align="left" width="120">驳回时间</th>
                    </tr>
                    @foreach ($customers as $value)
                        <tr>
                            <td><a href="{{ route('crm.checkcustomer.show',$value->id) }}" class="openwindow" title="商户详情">{{ $value->name }}</a></td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>{{ $value->user ? $value->user->realname : '/' }}</td>
                            <td>{{ $value->check_at ? $value->check_at->format('Y-m-d H:i') : '/' }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        {!! $customers->appends(['name' => request('name')])->appends(['type' => request('type')])->links() !!}
    </div>
@endsection