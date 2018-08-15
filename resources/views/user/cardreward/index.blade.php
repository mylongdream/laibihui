@extends('layouts.user.app')

@section('content')
    <div class="itemnav">
        <div class="title"><h3>{{ trans('user.cardreward') }}</h3></div>
        <ul class="tab">
            <li class="on"><a href="{{ route('user.cardreward.index') }}"><span>{{ trans('user.cardreward.list') }}</span></a></li>
            <li><a href="{{ route('user.cardreward.myreward') }}"><span>{{ trans('user.cardreward.myreward') }}</span></a></li>
        </ul>
    </div>
    <div class="cardreward mtw">
        @if ($list)
            <ul>
                @foreach ($list as $value)
                    <li>
                        <div class="pic"><img src="{{ uploadImage($value->upimage) }}" width="60" height="60"></div>
                        <div class="name">{{ $value->name }}</div>
                        <div class="info">所需卡数：{{ $value->cardnum }}张</div>
                        <div class="btn"><a href="javascript:;" class="disabled">点击兑换</a></div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection