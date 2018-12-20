@extends('layouts.common.loginpage')

@section('content')
	<div class="login-wrap">
		<img border="0" alt="" src="{{ $qrcode }}">
	</div>
@endsection

@section('script')
	<script type="text/javascript">
        $(function(){
            function loadwechatLogin(){
                var url = '{{ $checkurl }}';
                $.getJSON(url,function(data){
                    if(status === 1){
                        window.location.href = '{{ request('ReturnUrl') ? request('ReturnUrl') : route('index') }}';
                    }else{
                        window.setTimeout(function(){loadwechatLogin();},100);
                    }
                });
            }
            loadwechatLogin();
        });
	</script>
@endsection