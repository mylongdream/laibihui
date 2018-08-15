@extends('layouts.common.app')

@section('content')
    <div class="wp">
        <div class="buy-body">
            <p align="center"><img src="{{ asset('static/image/brand/card1.jpg') }}" alt=""></p>
            <p align="center"><a href="{{ route('brand.card.order') }}"><img src="{{ asset('static/image/brand/apply.gif') }}" alt=""></a></p>
            <p align="center"><img src="{{ asset('static/image/brand/card2.jpg') }}" alt=""></p>
            <p align="center"><img src="{{ asset('static/image/brand/card4.jpg') }}" alt=""></p>
        </div>
    </div>
@endsection