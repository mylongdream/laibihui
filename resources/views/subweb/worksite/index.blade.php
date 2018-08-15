@extends('subweb.layouts.app')

@section('content')
<div class="wp">
    <div class="mod-title cl">
        <div class="z">工地直播</div>
        <p>随时随地查看工地情况</p>
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
            <div class="mod-worksitelist cl">
                <ul>
                    @foreach ($worksites as $worksite)
                    <li>
                         <a href="{{ route('subweb.worksite.detail',[$worksite->city['domain'],$worksite->worksite_id]) }}" class="pic" title="{{ $worksite->subject }}"  target="_blank">
                        <img src="{{ $worksite->subjectimage }}" width="210" height="165" alt="{{ $worksite->subject }}">
                    </a>
                    <div class="info">
                        <strong><a href="{{ route('subweb.worksite.detail',[$worksite->city['domain'],$worksite->worksite_id]) }}" title="{{ $worksite->subject }}" target="_blank">{{ $worksite->subject }}</a></strong>
                        <div class="type">
                            <span><b class="gray-6">小区：</b>{{ $worksite->community->subject }}</span>
                            <span><b class="gray-6">风格：</b>简约</span>
                            <span><b class="gray-6">户型：</b>一居</span>
                            <span><b class="gray-6">面积：</b>57.6m²</span>
                            <span><b class="gray-6">造价：</b>67481.23</span>
                        </div>
                                                <dl class="step">
                                                            <dd class="on"><span></span><a href="#" title="开工大吉">开工大吉</a></dd>
                                                            <dd class="on"><span></span><a href="#" title="水电工程">水电工程</a></dd>
                                                            <dd class="on"><span></span><a href="#" title="泥水工程">泥水工程</a></dd>
                                                            <dd class="on"><span></span><a href="#" title="油漆工程">油漆工程</a></dd>
                                                            <dd class="on"><span></span><a href="#" title="完工">完工</a></dd>
                                                    </dl>
                    </div>
                    <a href="{{ route('subweb.worksite.detail',[$worksite->city['domain'],$worksite->worksite_id]) }}" class="btn" target="_blank"><i class="iconfont">&#xe624;</i>查看工地</a>

					</li>
                    @endforeach
                </ul>
            </div>
            {!! $worksites->links() !!}
    </div>
</div>
@endsection