@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="topheader">
                            <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                            <div class="nav">{{ trans('user.address') }}</div>
                        </div>
                        @if (count($addresses))
                            <div class="weui-cells" style="margin:0">
                                @foreach ($addresses as $value)
                                    <div class="weui-cell" data-geturl="{{ route('mobile.user.address.getitem',$value->id) }}">
                                        <div class="weui-cell__hd">
                                            <div class="weui-cells_checkbox" style="margin-right:10px">
                                                <input type="checkbox" class="weui-check" {!!  request('id') == $value->id ? 'checked="checked"' : '' !!}>
                                                <i class="weui-icon-checked"></i>
                                            </div>
                                        </div>
                                        <div class="weui-cell__bd">
                                            <p style="margin-bottom: 5px;">{{ $value->realname }}<span class="mlm">{{ $value->mobile }}</span> </p>
                                            <p style="font-size: 13px;color: #888888;">
                                                @if (auth()->user()->address_id == $value->id)
                                                    <span class="weui-badge" style="margin-right: 5px;">默认</span>
                                                @endif
                                                {{ $value->getprovince ? $value->getprovince->name : '' }} {{ $value->getcity ? $value->getcity->name : '' }} {{ $value->getarea ? $value->getarea->name : '' }} {{ $value->getstreet ? $value->getstreet->name : '' }}</p>
                                            <p style="font-size: 13px;color: #888888;">{{ $value->address }}</p>
                                        </div>
                                        <div class="weui-cell__ft" style="margin-left:5px;font-size: 14px;"><a href="{{ route('mobile.user.address.getedit',$value->id) }}" class="open-popup" data-target="#address_edit">编辑</a></div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-data">
                                <p>暂无数据！</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="{{ route('mobile.user.address.getadd') }}" class="weui-tabbar__item tabbar-btn open-popup" data-target="#address_add">
                <span>新建收货地址</span>
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("click", "#address_list .weui-cell__hd, #address_list .weui-cell__bd", function(){
            var self = $(this);
            $(".order-address").load(self.parent().data("geturl"));
            $('.popup-container').remove();
            return false;
        });
    </script>
@endsection
