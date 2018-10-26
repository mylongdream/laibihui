@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.zhaoshang.lackcard.index') }}">
            <div class="crm-search">
                <dl>
                    <dt>商户名称</dt>
                    <dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            <table>
                <tr>
                    <th align="left" colspan="2">商户名称</th>
                    <th align="left" width="150">预定卡数</th>
                    <th align="left" width="160">预定时间</th>
                    <th align="left" width="80">操作</th>
                </tr>
                @foreach ($list as $value)
                    <tr style="height: 90px">
                        <td width="60">
                            <a href="{{ route('brand.shop.show',$value->id) }}" target="_blank"><img src="{{ uploadImage($value->upimage) }}" width="60" height="60"></a>
                        </td>
                        <td>{{ $value->cardnum }} 张</td>
                        <td>{{ $value->created_at ? $value->created_at>format('Y-m-d H:i') : '/' }}</td>
                        <td>
                            <a href="{{ route('crm.zhaoshang.shop.edit', $value->id) }}" class="">处理</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $list->appends(['name' => request('name')])->links() !!}
    </div>
@endsection