@extends('layouts.common.simple')

@section('content')
    <div class="content-body">
        <div class="wp">
            <div class="container-box cl">
                <div class="announce-box cl">
                    <div class="hd cl">
                        <h3>{{ $announce->title }}</h3>
                    </div>
                    <div class="bd cl">
                        <div>{!! $announce->message !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection