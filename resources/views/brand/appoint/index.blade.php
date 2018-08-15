@extends('layouts.common.app')

@section('content')
    <div class="wp">
        <div class="buy-body">
            <p align="center"><img src="{{ asset('static/image/brand/card1.jpg') }}" alt="" width=""></p>
            <div class="buy-card">
                <div class="buy-tip">
                    请认真填写以下信息，我们会第一时间与您电话联系并上门为你办卡
                </div>
                <div class="buy-form">
                    <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('brand.buy.store') }}">
                        {!! csrf_field() !!}
                        <div class="line">
                            <dl>
                                <dt><span class="required">*</span>姓名</dt>
                                <dd><input class="text" type="text" size="50" value="" name="realname"></dd>
                            </dl>
                            <dl>
                                <dt><span class="required">*</span>性别</dt>
                                <dd>
                                    <label class="radio" for="gender_1">
                                        <input id="gender_1" type="radio" name="gender" value="1" checked> 男
                                    </label>
                                    <label class="radio" for="gender_2">
                                        <input id="gender_2" type="radio" name="gender" value="2"> 女
                                    </label>
                                </dd>
                            </dl>
                        </div>
                        <div class="line">
                            <dl>
                                <dt><span class="required">*</span>手机</dt>
                                <dd><input class="text" type="text" size="50" value="" name="mobile"></dd>
                            </dl>
                            <dl>
                                <dt>QQ</dt>
                                <dd><input class="text" type="text" size="50" value="" name="qq"></dd>
                            </dl>
                        </div>
                        <div class="line">
                            <dl>
                                <dt><span class="required">*</span>地址</dt>
                                <dd><input class="text" type="text" size="50" value="" name="address"></dd>
                            </dl>
                            <dl>
                                <dt>备注</dt>
                                <dd><input class="text" type="text" size="50" value="" name="remark"></dd>
                            </dl>
                        </div>
                        <div class="btn">
                            <button value="true" name="savesubmit" type="submit">预约办卡</button>
                        </div>
                    </form>
                </div>
            </div>
            <p align="center"><img src="{{ asset('static/image/brand/card2.jpg') }}" alt="" width=""></p>
            <p align="center"><img src="{{ asset('static/image/brand/card4.jpg') }}" alt="" width=""></p>
        </div>
    </div>
@endsection