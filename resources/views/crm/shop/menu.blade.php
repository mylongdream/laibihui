<div class="menu-box">
    <ul>
        <li class="{{ isset($curmenu) && $curmenu == 'index' ? 'on' : '' }}">
            <a title="" href="{{ route('crm.shop.index') }}"><span class="menu_index">系统首页</span></a>
        </li>

            <li class="{{ isset($curmenu) && $curmenu == 'consume' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.shop.consume.index') }}"><span class="menu_index">店铺消费</span></a>
            </li>
            @if (auth('crm')->user()->shop->ordercard)
            <li class="{{ isset($curmenu) && $curmenu == 'ordercard' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.shop.ordercard.index') }}"><span class="menu_index">店内办卡</span></a>
            </li>
            @endif
            @if (auth('crm')->user()->shop->appoint)
                <li class="{{ isset($curmenu) && $curmenu == 'appoint' ? 'on' : '' }}">
                    <a title="" href="{{ route('crm.shop.appoint.index') }}"><span class="menu_index">预约订座</span></a>
                </li>
            @endif
            @if (auth('crm')->user()->shop->ordermeal)
                <li class="{{ isset($curmenu) && $curmenu == 'ordermeal' ? 'on' : '' }}">
                    <a title="" href="{{ route('crm.shop.ordermeal.index') }}"><span class="menu_index">点餐管理</span></a>
                </li>
            @endif
            <li class="{{ isset($curmenu) && $curmenu == 'withdraw' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.shop.withdraw.index') }}"><span class="menu_index">提现记录</span></a>
            </li>
            <li class="{{ isset($curmenu) && $curmenu == 'checkout' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.shop.checkout.index') }}"><span class="menu_index">收银结账</span></a>
            </li>

    </ul>
</div>