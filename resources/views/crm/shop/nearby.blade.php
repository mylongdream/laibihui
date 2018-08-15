@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-list">
            <table>
                <tr>
                    <th align="left" colspan="2">商户名称</th>
                    <th align="left" width="120">相距距离</th>
                </tr>
                @foreach ($shops as $value)
                    <tr>
                        <td width="60">
                            <a href="{{ route('brand.shop.show',$value->id) }}" target="_blank"><img src="{{ uploadImage($value->upimage) }}" width="60" height="60"></a>
                        </td>
                        <td>
                            <p><a href="{{ route('brand.shop.show',$value->id) }}" target="_blank">{{ $value->name }}</a></p>
                            <p style="margin-top: 10px;color: #999">地址：{{ $value->address }}</p>
                        </td>
                        <td>{{ number_format($value->distance) }} 米</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection