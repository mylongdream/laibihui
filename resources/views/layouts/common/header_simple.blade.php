<div class="shead cl">
    <div class="wp">
        <div class="z">
            <h1 class="logo">
                <a title="{{ $setting['sitename'] }}" href="{{ route('index') }}"><img border="0" alt="{{ $setting['sitename'] }}" src="{{ asset('static/image/common/logo.png') }}"></a>
            </h1>
            <div class="home"><a href="{{ route('index') }}">首页</a></div>
            <div class="nav trigger-hover">
                <div class="txt">
                    <span><i class="z"></i>导航<i class="y"></i></span>
                </div>
                <div class="sub">
                    <ul>
                        @foreach ($navs->where('type', 'headernav')->where('parentid', '0') as $nav)
                            <li>
                                <a href="{{ url($nav->url) }}" title="{{ $nav->title }}" hidefocus="true" @if ($nav->target) target="_blank" @endif>{{ $nav->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="y">
            @auth
                <div class="user trigger-hover">
                    <div class="txt">
                        <div class="info">
                            <div class="avtm z"><img width="20" height="20" src="{{ auth()->user()->headimgurl ? uploadImage(auth()->user()->headimgurl) : asset('static/image/common/getheadimg.jpg') }}"></div>
                            <div class="username">{{auth()->user()->username}}</div>
                            <div class="arrow y"></div>
                        </div>
                    </div>
                    <div class="sub">
                        <ul>
                            <li>
                                <a hidefocus="true" href="{{ route('user.index') }}">个人中心</a>
                            </li>
                            <li>
                                <a hidefocus="true" href="{{ route('user.profile.index') }}">资料修改</a>
                            </li>
                            <li>
                                <a hidefocus="true" href="{{ route('user.password.index') }}">密码安全</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="logout">
                    <a href="{{ route('logout') }}">退出</a>
                </div>
            @else
                <div class="login">
                    <a href="{{ route('login', ['ReturnUrl' => request()->getUri()]) }}">登录</a>
                </div>
                <div class="register">
                    <a href="{{ route('register') }}">注册</a>
                </div>
            @endauth
        </div>
    </div>
</div>