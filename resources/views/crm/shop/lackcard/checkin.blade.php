@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="{{ route('crm.shop.lackcard.checkin') }}">缺卡登记</a></li>
            <li><a href="{{ route('crm.shop.lackcard.index') }}">订卡记录</a></li>
        </ul>
    </div>
	<div class="crm-main">
		<div class="crm-infobox">
			<div class="hd">
				<h4>缺卡登记</h4>
			</div>
			<div class="bd crm-form">
				<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.shop.lackcard.checkin') }}">
					{!! csrf_field() !!}
					<table>
						<tr>
							<td width="150" align="right">预订卡数</td>
							<td><input class="input" type="text" size="30" value="" name="cardnum" placeholder="请输入预订卡数"> 张</td>
						</tr>
						<tr>
							<td align="right"></td>
							<td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
@endsection