@extends('layouts.common.simple')

@section('content')
    <div class="content-body">
        <div class="wp">
            <div class="announce-list">
                <div class="hd">
                    <h3>系统公告</h3>
                </div>
                <div class="bd">
                    <ul>
                        @foreach ($announces as $value)
                            <li>
                                <a href="{{ route('announce.show', ['id'=>$value->id]) }}" target="_blank">
                                    <strong>{{ $value->title }}</strong><span>{{ $value->created_at->format('Y-m-d H:i') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {!! $announces->links() !!}
        </div>
    </div>
@endsection