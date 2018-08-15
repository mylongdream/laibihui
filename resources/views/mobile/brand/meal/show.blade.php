@extends('layouts.mobile.app')

@section('content')
    @if (!request()->ajax())
        <div class="weui-tab">
            <div class="wp">
                <div class="meal-show">
                    <div class="m-pic">
                        <img src="{{ uploadImage($meal->upimage) }}" alt="">
                    </div>
                    <div class="m-info">
                        <div class="m-name">{{ $meal->name }}</div>
                        <div class="m-price">￥ <em>{{ $meal->price }}</em></div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="meal-show">
            <div class="m-pic">
                <img src="{{ uploadImage($meal->upimage) }}" alt="">
                @if ($meal->message)
                    <span>{{ $meal->message }}</span>
                @endif
            </div>
            <div class="m-info">
                <div class="m-name">{{ $meal->name }}</div>
                <div class="m-extra cl">
                    <div class="m-price">￥ <em>{{ $meal->price }}</em></div>
                    <div class="m-order">
                        @if ($meal->cart)
                            <button name="" type="button" class="disabled">已点选</button>
                        @else
                            <button name="" type="button" class="meal-order-btn">点这个</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
