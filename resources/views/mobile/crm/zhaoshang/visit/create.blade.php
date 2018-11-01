@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">新增随访记录</div>
				</div>
				<form class="ajaxform" name="myform" method="post" action="{{ route('mobile.crm.zhaoshang.visit.store') }}">
					{!! csrf_field() !!}
					<div class="weui-cells__title">随访记录内容</div>
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<textarea name="message" class="weui-textarea" placeholder="" rows="6"></textarea>
								<div class="weui-textarea-counter"><span>0</span>/200</div>
							</div>
						</div>
					</div>
					<div class="weui-btn-area">
						<button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">提 交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection