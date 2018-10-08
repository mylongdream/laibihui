@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>查看客户资料</h4>
            </div>
            <div class="bd crm-form">
                    <div class="subtitle">基本信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td>{{ $archive->shop->name }}</td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">展示图片</td>
                            <td>
                                <div class="uploadbox">
                                    <ul>
                                        @if ($archive->upphoto)
                                            @foreach (unserialize($archive->upphoto) as $upphoto)
                                                <li>
                                                    <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="subtitle">店铺介绍</div>
                <div style="overflow:hidden">
                        {!! $archive->message !!}
                    </div>
            </div>
        </div>
    </div>
@endsection