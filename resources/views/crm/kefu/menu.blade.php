<div class="menu-box">
    <ul>
        <li class="{{ isset($curmenu) && $curmenu == 'index' ? 'on' : '' }}">
            <a title="" href="{{ route('crm.kefu.index') }}"><span class="menu_index">系统首页</span></a>
        </li>
            <li class="{{ isset($curmenu) && $curmenu == 'checkcustomer' ? 'on' : '' }}">
                <a title="" href="{{ route('crm.kefu.checkcustomer.index') }}"><span class="menu_index">客户审查</span></a>
            </li>
    </ul>
</div>