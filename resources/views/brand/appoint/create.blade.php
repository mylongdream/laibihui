<div class="appoint">
        <form id="appointForm" class="ajaxform" action="{{ route('appoint.store') }}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" value="{{ request('type') }}" name="type">
                <input type="hidden" value="{{ request('id') }}" name="id">
                <div class="ipt">
                        <dl class="cl">
                                <dt>您的姓名：</dt>
                                <dd><input type="text" name="realname" class="px"></dd>
                        </dl>
                        <dl class="cl">
                                <dt>手机号码：</dt>
                                <dd><input type="text" name="mobile" class="px"></dd>
                        </dl>
                        <dl class="cl">
                                <dt>验证码：</dt>
                                <dd>
                                        <input type="text" name="verify" class="verify">
                                        <input id="getSmsCode" class="verify-btn" type="button" data-status="0" disabled="disabled" value="发送验证码">
                                </dd>
                        </dl>
                </div>
                <div class="btn">
                        <button name="appointbtn" type="submit" class="formdialog">免费预约</button>
                </div>
        </form>
</div>


