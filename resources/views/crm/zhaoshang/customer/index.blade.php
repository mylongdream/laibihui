@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="{{ route('crm.customer.index') }}">客户管理</a></li>
            <li><a href="{{ route('crm.customer.referlist') }}">客户审核</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.customer.index') }}">
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
                    <th align="left" width="100">跟进情况</th>
                    <th align="left" width="80">审核</th>
                    <th align="left" width="80">操作</th>
                </tr>
                @foreach ($customers as $value)
                    <tr>
                        <td><a href="{{ route('crm.customer.show',$value->id) }}" class="openwindow" title="商户详情">{{ $value->name }}</a></td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ trans('crm.customer.status_'.$value->status) }}</td>
                        <td>
                            @if ($value->status == 'finish')
                            <a href="{{ route('crm.customer.refer',$value->id) }}" class="">提交审核</a>
                            @else
                                <span>/</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('crm.customer.edit',$value->id) }}" class="">{{ trans('crm.edit') }}</a>
                            <a href="{{ route('crm.customer.destroy',$value->id) }}" class="mlm delbtn">{{ trans('crm.destroy') }}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $customers->appends(['name' => request('name')])->appends(['address' => request('address')])->links() !!}
    </div>
@endsection