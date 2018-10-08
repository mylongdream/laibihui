@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="{{ route('crm.zhaoshang.shop.index') }}">成功客户</a></li>
            <li><a href="{{ route('crm.zhaoshang.archive.index') }}">客户修改审核</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.zhaoshang.shop.index') }}">
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
                    <th align="left" width="150">联名卡</th>
                    <th align="left" width="160">有效期限</th>
                    <th align="left" width="80">操作</th>
                </tr>
                @foreach ($shops as $value)
                    <tr style="height: 90px">
                        <td width="60">
                            <a href="{{ route('brand.shop.show',$value->id) }}" target="_blank"><img src="{{ uploadImage($value->upimage) }}" width="60" height="60"></a>
                        </td>
                        <td>
                            <p><a href="{{ route('brand.shop.show',$value->id) }}" target="_blank">{{ $value->name }}</a></p>
                            <p style="margin-top: 10px;color: #999">地址：{{ $value->address }}</p>
                        </td>
                        <td>
                            <p>已分配：{{ $value->shopcards_count }} 张</p>
                            <p style="margin-top: 10px;">已发行：{{ $value->sellcards_count }} 张</p>
                        </td>
                        <td>
                            <p>起：{{ $value->started_at ? $value->started_at->format('Y-m-d H:i') : '/' }}</p>
                            <p style="margin-top: 10px;">止：{{ $value->ended_at ? $value->ended_at->format('Y-m-d H:i') : '/' }}</p>
                        </td>
                        <td>
                            <p><a href="{{ route('crm.zhaoshang.shop.edit', $value->id) }}" class="">修改资料</a></p>
                            <p style="margin-top: 10px;"><a href="{{ route('crm.zhaoshang.shop.allot', $value->id) }}">分配卡号</a></p>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $shops->appends(['name' => request('name')])->appends(['address' => request('address')])->links() !!}
    </div>
@endsection