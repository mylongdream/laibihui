@extends('layouts.crm.app')

@section('content')
	<div class="crm-tabnav">
		<ul>
			<li><a href="{{ route('crm.shop.sellcard.index') }}">办卡二维码</a></li>
			<li class="on"><a href="{{ route('crm.shop.sellcard.order') }}">售卡记录</a></li>
		</ul>
	</div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.shop.sellcard.order') }}">
            <div class="crm-search">
                <dl>
                    <dt>卡号</dt>
                    <dd><input type="text" name="number" class="schtxt" value="{{ request('number') }}"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left">卡号</th>
					<th align="left" width="100">绑卡用户</th>
					<th align="left" width="180">绑卡时间</th>
				</tr>
				@foreach ($orders as $value)
					<tr>
						<td>{{ $value->number }}</td>
						<td>{{ $value->card->user->username }}</td>
                        <td>{{ $value->created_at->format('Y-m-d H:i:s') }}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{!! $orders->appends(['number' => request('number')])->links() !!}
	</div>
@endsection