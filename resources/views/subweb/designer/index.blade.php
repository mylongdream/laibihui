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
            <div class="mod-designerlist cl">
                <ul>
                    @foreach ($designers as $designer)
                    <li><a href="{{ route('designer.detail',$designer->designer_id) }}">{{ $designer->subject }}</a> <a href="{{ route('subweb.designer.detail',[$designer->city['domain'],$designer->designer_id]) }}">{{ $designer->designer_id }}</a></li>
                    @endforeach
                </ul>
            </div>
            {!! $designers->links() !!}
        </div>
        <div class="sd">
        </div>
    </div>
</div>
@endsection