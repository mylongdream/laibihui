@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-list mtw">
            <table>
                <tr>
                    <th align="left">订卡用户</th>
                    <th align="left" width="150">预定卡数</th>
                    <th align="left" width="160">预定时间</th>
                    <th align="left" width="80">操作</th>
                </tr>
                @foreach ($list as $value)
                    <tr>
                        <td>{{ $value->user->username }}</td>
                        <td>{{ $value->cardnum }} 张</td>
                        <td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
                        <td>
                            @if ($value->status)
                                <span>已经处理</span>
                            @else
                                <a href="{{ route('crm.zhaoshang.lackcard.handle', $value->id) }}" class="ajaxget confirmbtn" title="处理">点击处理</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $list->links() !!}
    </div>
@endsection