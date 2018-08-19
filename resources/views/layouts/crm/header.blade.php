<div class="crm-head cl">
    <div class="wp">
        <div class="z">
            <h1 class="logo">
                <a href="javascript:;"><img border="0" alt="{{ $setting['sitename'] }}" src="{{ asset('static/image/common/logo.png') }}"></a>
            </h1>
            <div class="name">
                CRM管理系统
            </div>
        </div>
        @auth('crm')
        <div class="y">
            <div class="user">
                <strong>{{config('crm.group.'.auth('crm')->user()->group->module.'.name')}}：{{auth('crm')->user()->username}}</strong>
            </div>
            <div class="logout">
                <a href="{{ route('crm.logout') }}">退出</a>
            </div>
        </div>
        @endauth
    </div>
</div>