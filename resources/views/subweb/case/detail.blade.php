@extends('subweb.layouts.app')

@section('content')

        <p>This is user {!! $case->content !!}</p>
        <a href="{{ route('subweb.case.detail',[$case->city['domain'],$case->case_id]) }}">ddddddddddd</a>
        <p>This is user {!! $case->designer->subject !!}</p>
@endsection