@extends('subweb.layouts.app')

@section('content')
<div class="wp">
    <div class="mod-title cl">
        <div class="z">家装案例</div>
        <p>如果你不知道怎么装修，来看看这里</p>
    </div>
    <div id="attr-sort" class="attr-sort">
        @foreach ($attrs as $attr)
        <dl class="cl">
            <dt>{{ $attr->title }}</dt>
            <dd>
                <a href="" class="a">不限</a>
            @foreach ($attr->values as $value)
            <a href="">{{ $value->title }}</a>
            @endforeach
            </dd>
        </dl>
        @endforeach
    </div>
    <div class="mod-content cl">
        <div class="mn">
            <div class="mod-caselist cl">
                <ul>
                    @foreach ($cases as $case)
                    <li><a href="">{{ $case->subject }}</a> <a href="{{ route('subweb.case.detail',[$case->city['domain'],$case->case_id]) }}">{{ $case->case_id }}</a></li>
                    @endforeach
                </ul>
            </div>
            {!! $cases->links() !!}
        </div>
        <div class="sd">
        </div>
    </div>
</div>
@endsection