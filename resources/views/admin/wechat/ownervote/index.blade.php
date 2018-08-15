@extends('layouts.admin.app')

@section('content')
    <div class="itemnav">
        <div class="title"><h3>业主评选</h3></div>
        <ul class="tab">
            <li class="current"><a href="{{ route('admin.wechat.ownervote.index') }}"><span>基本设置</span></a></li>
            <li><a href="{{ route('admin.wechat.ownervote.apply') }}"><span>参与用户</span></a></li>
            <li><a href="{{ route('admin.wechat.ownervote.vote') }}"><span>投票记录</span></a></li>
            <li><a href="{{ route('admin.wechat.ownervote.visit') }}"><span>访问记录</span></a></li>
            <li><a href="{{ route('admin.wechat.ownervote.share') }}"><span>分享记录</span></a></li>
        </ul>
    </div>
    <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.wechat.ownervote.index') }}">
        {!! csrf_field() !!}
        <div class="tbedit">
            <table>
                <tr>
                    <td width="150" align="right">活动地址</td>
                    <td>{{ route('wechat.ownervote.index') }}</td>
                </tr>
                <tr>
                    <td align="right">分享标题</td>
                    <td><input class="txt" type="text" size="50" value="{{ $setting['sharetitle'] or '' }}" name="setting[sharetitle]"></td>
                </tr>
                <tr>
                    <td align="right">分享描述</td>
                    <td><input class="txt" type="text" size="50" value="{{ $setting['sharedec'] or '' }}" name="setting[sharedec]"></td>
                </tr>
                <tr>
                    <td align="right">分享封面</td>
                    <td>
                        <a href="javascript:;" class="upbtn" id="banner">上传图片</a><span class="tdtip">建议尺寸为 320 X 320 像素大小</span>
                        <div class="uploadbox">
                            <ul>
                                @if ($setting['sharepic'])
                                    <li class="trigger-hover">
                                        <img src="{{ uploadImage($setting['sharepic']) }}" width="120" height="120">
                                        <input name="banner" value="{{ $setting['sharepic'] }}" type="hidden">
                                        <div class="handle"><span class="setdel">删除</span></div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right">活动时间</td>
                    <td><input class="txt" type="text" size="20" value="2018-03-01 00:00:00" id="starttime" name="setting[starttime]"> -- <input class="txt" type="text" size="20" value="2018-03-30 00:00:00" id="endtime" name="setting[endtime]"><span class="tdtip">该活动时间内生效</span></td>
                </tr>
                <tr>
                    <td align="right">活动规则</td>
                    <td><textarea class="textarea" name="setting[statcode]" cols="60" rows="5">{{ $setting['statcode'] or '' }}</textarea></td>
                </tr>
                <tr>
                    <td align="right">访问次数</td>
                    <td><input class="txt" type="text" size="50" value="{{ $setting['sharedec'] or '' }}" name="setting[sharedec]"></td>
                </tr>
                <tr>
                    <td align="right">是否需要关注</td>
                    <td>
                        <label class="radio" for="bbclosed_1">
                            <input id="bbclosed_1" type="radio" name="setting[bbclosed]" value="1" {{ isset($setting['bbclosed'])&&$setting['bbclosed'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
                        </label>
                        <label class="radio" for="bbclosed_0">
                            <input id="bbclosed_0" type="radio" name="setting[bbclosed]" value="0" {{ isset($setting['bbclosed'])&&$setting['bbclosed'] ? '' : 'checked' }}> {{ trans('admin.no') }}
                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td><input class="subtn" type="submit" value="提 交" name="submit"></td>
                </tr>
            </table>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/kindeditor/kindeditor.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#banner").powerWebUpload({
                server: "{{ route('admin.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'banner',
                width: 120,
                height: 120
            });
            laydate({
                elem: '#starttime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
            });
            laydate({
                elem: '#endtime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
            });
        });
        KindEditor.ready(function(K) {
            var ItemEditor = K.create("#message", {
                uploadJson : "{{ route('admin.upload.editor') }}",
                extraFileUploadParams : {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                afterBlur: function () { this.sync(); }
            });
        });
    </script>
@endsection
