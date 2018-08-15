@extends('subweb.layouts.app')

@section('content')

        <p>This is user {!! $worksite->content !!}</p>
        <p>This is user {!! $worksite->manager->subject !!}</p>

@endsection