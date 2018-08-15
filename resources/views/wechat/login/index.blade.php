@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <form class="" name="myform" method="post" action="{{ route('wechat.login') }}">
                {!! csrf_field() !!}
                <input name="type" class="action_type" value="login" type="hidden" />
                <input name="ReturnUrl" value="{{ request('ReturnUrl') }}" type="hidden" />
                <div class="weui-msg">
                    <div class="weui-msg__icon-area">
                        <img src="{{ $user && $user->headimgurl ? uploadImage($user->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" class="radius" style="width:93px;height:93px;">
					</div>
                    <div class="weui-msg__text-area">
                        <h2 class="weui-msg__title">{{ $user->username }}</h2>
                        <p class="weui-msg__desc">您可以快速登录当前账户</p>
                    </div>
                    <div class="weui-msg__opr-area">
                        <p class="weui-btn-area">
                            <button type="button" class="weui-btn weui-btn_primary ajaxsubmit" onclick="addAction('login')">快速登录</button>
                            <button type="button" class="weui-btn weui-btn_default ajaxsubmit" onclick="addAction('logout')">切换账号</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function addAction(type){
            $('.action_type').val(type);
            //document.myform.submit();
        }
    </script>
@endsection