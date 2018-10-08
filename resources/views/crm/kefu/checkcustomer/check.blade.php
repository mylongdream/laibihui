@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>提交审核</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.kefu.checkcustomer.check',$customer->id) }}">
                    {!! csrf_field() !!}
                    <div class="subtitle">基本信息</div>
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
                            <td align="right">地址坐标</td>
                            <td>{{ $customer->maplng }} X {{ $customer->maplat }}
                                <a href="{{ route('crm.kefu.shop.nearby', ['catid' => $customer->catid, 'maplng' => $customer->maplng, 'maplat' => $customer->maplat]) }}" class="openwindow clickbtn mlm" id="nearby" title="附近店铺">附近店铺</a>
                            </td>
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
                    <div class="subtitle">照片信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right" valign="top">合同照片</td>
                            <td>
                                @if ($customer->pic_hetong)
                                    <div class="uploadbox">
                                        <ul>
                                            @foreach (unserialize($customer->pic_hetong) as $upphoto)
                                                <li data-src="{{ uploadImage($upphoto) }}">
                                                    <a href=""><img src="{{ uploadImage($upphoto) }}" width="120" height="120"></a>
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
                                                <li data-src="{{ uploadImage($upphoto) }}">
                                                    <a href=""><img src="{{ uploadImage($upphoto) }}" width="120" height="120"></a>
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
                                                <li data-src="{{ uploadImage($upphoto) }}">
                                                    <a href=""><img src="{{ uploadImage($upphoto) }}" width="120" height="120"></a>
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
                                                <li data-src="{{ uploadImage($upphoto) }}">
                                                    <a href=""><img src="{{ uploadImage($upphoto) }}" width="120" height="120"></a>
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
                                                <li data-src="{{ uploadImage($upphoto) }}">
                                                    <a href=""><img src="{{ uploadImage($upphoto) }}" width="120" height="120"></a>
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
                                                <li data-src="{{ uploadImage($upphoto) }}">
                                                    <a href=""><img src="{{ uploadImage($upphoto) }}" width="120" height="120"></a>
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
                    <div class="subtitle">审核信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right">审核状态</td>
                            <td class="checkstatus">
                                <label class="radio" for="status_0"><input value="passed" name="status" id="status_0" type="radio" checked>审核通过</label>
                                <label class="radio" for="status_1"><input value="rejected" name="status" id="status_1" type="radio">审核不通过</label>
                            </td>
                        </tr>
                        <tr class="checkshop">
                            <td align="right">店铺ID</td>
                            <td><input class="input" type="text" size="50" value="" name="shop_id" placeholder=""><span class="mlm tdtip">加完店铺后将店铺ID填入此处</span></td>
                        </tr>
                        <tr class="checkreason hidden">
                            <td align="right">驳回原因</td>
                            <td><textarea class="textarea" name="reason" cols="60" rows="4"></textarea></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link href="{{ asset('static/js/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/lightgallery/js/lightgallery-all.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $(".uploadbox ul").lightGallery({
                thumbnail:true,
                animateThumb: false,
                showThumbByDefault: false
            });
            $(document).on("click", ".checkstatus label", function(){
                var self = $(this);
                setTimeout(function() {
                    if (self.find("input").val() === 'rejected') {
                        $(".checkreason").show();
                        $(".checkshop").hide();
                    } else {
                        $(".checkreason").hide();
                        $(".checkshop").show();
                    }
                }, 0)
            });
        });
    </script>
@endsection