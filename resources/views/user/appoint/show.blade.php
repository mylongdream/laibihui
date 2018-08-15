@extends('layouts.user.app')

@section('content')
    @if (!request()->ajax())
        <div class="itemnav">
            <div class="title"><h3>{{ trans('user.appoint') }}</h3></div>
        </div>
        <div class="order-show mtw">
            <table>
                <tr>
                    <th width="20%" align="right">{{ trans('user.appoint.realname') }}</th>
                    <td>{{ $appoint->realname }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.mobile') }}</th>
                    <td>{{ $appoint->mobile or '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.number') }}</th>
                    <td>{{ $appoint->number or '0' }} 人</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.appoint_at') }}</th>
                    <td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.remark') }}</th>
                    <td>{{ $appoint->remark or '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.status') }}</th>
                    <td>{{ trans('user.appoint.status_'.$appoint->status) }}</td>
                </tr>
                @if ($appoint->status != 0)
                    <tr>
                        <th align="right">{{ trans('admin.brand.appoint.reason') }}</th>
                        <td>{{ $appoint->reason }}</td>
                    </tr>
                @endif
            </table>
        </div>
    @else
        <div class="order-show" style="width: 450px;">
            <table>
                <tr>
                    <th width="30%" align="right">{{ trans('user.appoint.realname') }}</th>
                    <td>{{ $appoint->realname }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.mobile') }}</th>
                    <td>{{ $appoint->mobile or '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.number') }}</th>
                    <td>{{ $appoint->number or '0' }} 人</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.appoint_at') }}</th>
                    <td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.remark') }}</th>
                    <td>{{ $appoint->remark or '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.appoint.status') }}</th>
                    <td>{{ trans('user.appoint.status_'.$appoint->status) }}</td>
                </tr>
                @if ($appoint->status != 0)
                    <tr>
                        <th align="right">{{ trans('admin.brand.appoint.reason') }}</th>
                        <td>{{ $appoint->reason }}</td>
                    </tr>
                @endif
            </table>
        </div>
    @endif
@endsection