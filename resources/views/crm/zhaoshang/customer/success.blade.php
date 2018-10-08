@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.zhaoshang.customer.index') }}">
            <div class="crm-search">
                <dl>
                    <dt>{{ trans('crm.customer.name') }}</dt>
                    <dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            <table>
                <tr>
                    <th align="left" width="180">商户名称</th>
                    <th align="left">商户地址</th>
                    <th align="left" width="120">联系方式</th>
                    <th align="left" width="100">有效期限</th>
                </tr>
                @foreach ($customers as $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->phone }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $customers->appends(['name' => request('name')])->appends(['address' => request('address')])->links() !!}
    </div>
@endsection