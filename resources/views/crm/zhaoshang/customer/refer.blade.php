@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>提交审核</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.zhaoshang.customer.refer',$customer->id) }}">
                    {!! csrf_field() !!}
                    <div class="subtitle">基本信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <td width="150" align="right">商户地址</td>
                            <td>{{ $customer->address }}</td>
                        </tr>
                    </table>
                    <div class="subtitle">照片信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right" valign="top">合同照片</td>
                            <td>
                                @if ($customer->pic_hetong)
                                    <div class="uploadbox">
                                        <ul>
                                            @foreach (unserialize($customer->pic_hetong) as $upphoto)
                                                <li>
                                                    <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div>暂无图片</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="150" align="right" valign="top">商户资质照片</td>
                            <td>
                                @if ($customer->pic_zizhi)
                                    <div class="uploadbox">
                                        <ul>
                                            @foreach (unserialize($customer->pic_zizhi) as $upphoto)
                                                <li>
                                                    <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div>暂无图片</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">店铺门头照片</td>
                            <td>
                                @if ($customer->pic_mentou)
                                    <div class="uploadbox">
                                        <ul>
                                            @foreach (unserialize($customer->pic_mentou) as $upphoto)
                                                <li>
                                                    <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div>暂无图片</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">店铺内景照片</td>
                            <td>
                                @if ($customer->pic_neijing)
                                    <div class="uploadbox">
                                        <ul>
                                            @foreach (unserialize($customer->pic_neijing) as $upphoto)
                                                <li>
                                                    <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div>暂无图片</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">菜单价目照片</td>
                            <td>
                                @if ($customer->pic_caidan)
                                    <div class="uploadbox">
                                        <ul>
                                            @foreach (unserialize($customer->pic_caidan) as $upphoto)
                                                <li>
                                                    <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div>暂无图片</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">特色菜品照片</td>
                            <td>
                                @if ($customer->pic_caipin)
                                    <div class="uploadbox">
                                        <ul>
                                            @foreach (unserialize($customer->pic_caipin) as $upphoto)
                                                <li>
                                                    <img src="{{ uploadImage($upphoto) }}" width="120" height="120">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div>暂无图片</div>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提交审核</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection