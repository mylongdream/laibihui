
<input type="hidden" name="user_id" value="{{ $userinfo->uid }}">
<ul>
    <li>用户名：<span>{{ $userinfo->username }}</span></li>
    <li>会员姓名：<span>{{ $userinfo->realname or '无' }}</span></li>
    <li>手机号码：<span>{{ $userinfo->mobile or '无' }}</span></li>
    <li>到店体验金：<span>{{ $userinfo->tiyan_money }} 元</span></li>
    <li>可用积分：<span>{{ $userinfo->score }} 个</span></li>
    <li>可用余额：<span>{{ $userinfo->user_money }} 元</span></li>
</ul>

