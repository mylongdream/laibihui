@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li><a href="{{ route('crm.shop.ordermeal.index') }}">自助点餐明细</a></li>
            <li class="on"><a href="{{ route('crm.shop.ordermeal.create') }}">我要点餐</a></li>
        </ul>
    </div>
	<div class="crm-main">

	</div>
@endsection