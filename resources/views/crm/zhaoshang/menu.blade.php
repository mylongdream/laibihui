<div class="menu-box">
    <ul>
        <li class="{{ isset($curmenu) && $curmenu == 'index' ? 'on' : '' }}">
            <a title="" href="{{ route('crm.zhaoshang.index') }}"><span class="menu_index">系统首页</span></a>
        </li>
            <li class="{{ isset($curmenu) && $curmenu == 'addcustomer' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.zhaoshang.customer.create') }}"><span class="menu_index">新增客户</span></a>
            </li>
            <li class="{{ isset($curmenu) && $curmenu == 'customer' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.zhaoshang.customer.index') }}"><span class="menu_index">客户管理</span></a>
            </li>
            <li class="{{ isset($curmenu) && $curmenu == 'shop' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.zhaoshang.shop.index') }}"><span class="menu_index">成功客户</span></a>
            </li>
            <li class="{{ isset($curmenu) && $curmenu == 'follow' ? 'on' : '' }}">
                <a title="" href="javascript:;"><span class="menu_index">跟单管理</span></a>
            </li>
            <li class="{{ isset($curmenu) && $curmenu == 'service' ? 'on' : '' }}">
                <a title="" href="javascript:;"><span class="menu_index">售后服务</span></a>
            </li>
            <li class="{{ isset($curmenu) && $curmenu == 'charge' ? 'on' : '' }}">
                <a title="" href="javascript:;"><span class="menu_index">费用管理</span></a>
            </li>
    </ul>
</div>