@extends('layouts.crm.app')

@section('content')
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>新增客户</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.zhaoshang.customer.store') }}">
                    {!! csrf_field() !!}
                    <div class="subtitle">必填信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right">经营类目</td>
                            <td>
                                <select class="select" name="catid">
                                    <option value="">请选择</option>
                                    @foreach ($categorylist as $scategory)
                                        <option value="{{ $scategory->id }}">{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td><input class="input" type="text" size="50" value="" name="name" placeholder=""></td>
                        </tr>
                        <tr>
                            <td align="right">商户地址</td>
                            <td><input class="input" type="text" size="50" value="" name="address" placeholder=""></td>
                        </tr>
                        <tr>
                            <td align="right">地址坐标</td>
                            <td>
                                <input class="input" type="text" size="15" value="" name="maplng" id="maplng" style="width: 120px"> X <input class="input" type="text" size="15" value="" name="maplat" id="maplat" style="width: 120px">
                                <a href="javascript:;" class="clickbtn mlm" id="mapmark">点击标注</a>
                                <a href="{{ route('crm.zhaoshang.customer.nearby') }}" class="clickbtn mlm openwindow" title="附近店铺">附近店铺</a>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">联系电话</td>
                            <td><input class="input" type="text" size="50" value="" name="phone" placeholder=""></td>
                        </tr>
                        <tr>
                            <td align="right">营业时间</td>
                            <td><input class="input" type="text" size="50" value="" name="openhours" placeholder=""></td>
                        </tr>
                        <tr>
                            <td align="right">跟进情况</td>
                            <td class="fillstatus">
                                <label class="radio" for="status_0"><input value="touch" name="status" id="status_0" type="radio" checked >初步接触</label>
                                <label class="radio" for="status_1"><input value="purpose" name="status" id="status_1" type="radio">有意向</label>
                                <label class="radio" for="status_2"><input value="develop" name="status" id="status_2" type="radio" >开发中</label>
                                <label class="radio" for="status_3"><input value="giveup" name="status" id="status_3" type="radio" >已放弃</label>
                                <label class="radio" for="status_4"><input value="finish" name="status" id="status_4" type="radio" >已完成</label>
                            </td>
                        </tr>
                    </table>
                    <div class="fillinfo">
                        <div class="subtitle">上传照片</div>
                        <table>
                            <tr>
                                <td width="150" align="right" valign="top">合同照片</td>
                                <td>
                                    <p class="tdtip">格式要求：支持.jpg .jpeg .bmp .gif .png格式照片，大小不超过5M。</p>
                                    <a href="javascript:;" class="upbtn" id="pic_hetong">上传图片</a>
                                    <div class="uploadbox"><ul></ul></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="top">商户资质照片</td>
                                <td>
                                    <p class="tdtip">格式要求：支持.jpg .jpeg .bmp .gif .png格式照片，大小不超过5M。</p>
                                    <a href="javascript:;" class="upbtn" id="pic_zizhi">上传图片</a>
                                    <div class="uploadbox"><ul></ul></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="top">店铺门头照片</td>
                                <td>
                                    <p class="tdtip">格式要求：支持.jpg .jpeg .bmp .gif .png格式照片，大小不超过5M。</p>
                                    <a href="javascript:;" class="upbtn" id="pic_mentou">上传图片</a>
                                    <div class="uploadbox"><ul></ul></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="top">店铺内景照片</td>
                                <td>
                                    <p class="tdtip">格式要求：支持.jpg .jpeg .bmp .gif .png格式照片，大小不超过5M。</p>
                                    <a href="javascript:;" class="upbtn" id="pic_neijing">上传图片</a>
                                    <div class="uploadbox"><ul></ul></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="top">菜单价目照片</td>
                                <td>
                                    <p class="tdtip">格式要求：支持.jpg .jpeg .bmp .gif .png格式照片，大小不超过5M。</p>
                                    <a href="javascript:;" class="upbtn" id="pic_caidan">上传图片</a>
                                    <div class="uploadbox"><ul></ul></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="top">特色菜品照片</td>
                                <td>
                                    <p class="tdtip">格式要求：支持.jpg .jpeg .bmp .gif .png格式照片，大小不超过5M。</p>
                                    <a href="javascript:;" class="upbtn" id="pic_caipin">上传图片</a>
                                    <div class="uploadbox"><ul></ul></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="subtitle">选填信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right" valign="top">备注其它</td>
                            <td><textarea class="textarea" name="remark" cols="60" rows="4"></textarea></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.amap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $(document).on("click", ".fillstatus .label", function(){
                var self = $(this);
                setTimeout(function() {
                    if (self.find("input").val() === 'finish') {
                        $(".fillinfo").show();
                    } else {
                        $(".fillinfo").hide();
                    }
                }, 0)
            });
            $("#mapmark").amap({
                AddressId: '#address',
                maplngId: '#maplng',
                maplatId: '#maplat',
                width: 800,
                height: 500
            });
            $("#pic_hetong").powerWebUpload({
                server: "{{ route('crm.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'pic_hetong[]',
                fileNumLimit: 20,
                width: 120,
                height: 120
            });
            $("#pic_zizhi").powerWebUpload({
                server: "{{ route('crm.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'pic_zizhi[]',
                fileNumLimit: 20,
                width: 120,
                height: 120
            });
            $("#pic_mentou").powerWebUpload({
                server: "{{ route('crm.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'pic_mentou[]',
                fileNumLimit: 20,
                width: 120,
                height: 120
            });
            $("#pic_neijing").powerWebUpload({
                server: "{{ route('crm.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'pic_neijing[]',
                fileNumLimit: 20,
                width: 120,
                height: 120
            });
            $("#pic_caidan").powerWebUpload({
                server: "{{ route('crm.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'pic_caidan[]',
                fileNumLimit: 20,
                width: 120,
                height: 120
            });
            $("#pic_caipin").powerWebUpload({
                server: "{{ route('crm.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'pic_caipin[]',
                fileNumLimit: 20,
                width: 120,
                height: 120
            });
        });
    </script>
@endsection