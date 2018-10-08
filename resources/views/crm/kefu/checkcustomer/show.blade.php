@extends('layouts.crm.app')

@section('content')
    @if (!request()->ajax())
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="bd crm-form">
                    <table>
                        <tr>
                            <td align="right">经营类目</td>
                            <td>{{ $customer->category->name }}</td>
                        </tr>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <td align="right">商户地址</td>
                            <td>{{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <td align="right">联系电话</td>
                            <td>{{ $customer->phone }}</td>
                        </tr>
                        <tr>
                            <td align="right">备注其它</td>
                            <td>{{ $customer->remark }}</td>
                        </tr>
                    </table>
            </div>
        </div>
    </div>
    @else
        <div class="crm-form">
            <table>
                <tr>
                    <td width="150" align="right">经营类目</td>
                    <td width="450">{{ $customer->category->name }}</td>
                </tr>
                <tr>
                    <td align="right">商户名称</td>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <td align="right">商户地址</td>
                    <td>{{ $customer->address }}</td>
                </tr>
                <tr>
                    <td align="right">联系电话</td>
                    <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                    <td align="right">备注其它</td>
                    <td>{{ $customer->remark }}</td>
                </tr>
            </table>
        </div>
    @endif
@endsection