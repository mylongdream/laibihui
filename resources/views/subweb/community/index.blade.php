@extends('subweb.layouts.app')

@section('content')
<div class="wp">
    <div class="mod-title cl">
        <div class="z">家装案例</div>
        <p>如果你不知道怎么装修，来看看这里</p>
    </div>
    <div class="mod-content cl">
        <div class="mn">
            <div class="mod-communitylist cl">
                <ul>
                    @foreach ($communitys as $community)
                    <li>
						<div class="pic">
							<a class="thumb" href="{{ route('subweb.community.detail',[$community->city['domain'],$community->community_id]) }}"><img width="275" height="185" alt="{{ $community->subject }}" src="{{ $community->subjectimage }}"></a>
							<p>装修过该小区的设计师：</p>
							<div class="sjs">
                    			@foreach ($community->designers->take(2) as $designer)
								<a title="{{ $designer->subject }}" href="{{ route('subweb.designer.detail',[$designer->city['domain'],$designer->designer_id]) }}"><img width="48" height="48" alt="{{ $designer->subject }}" src="{{ $designer->subjectimage }}"><span>{{ $designer->subject }}</span></a>
                    			@endforeach
							</div>
						</div>
						<div class="info">
							<a class="tit" title="{{ $community->subject }}" href="{{ route('subweb.community.detail',[$community->city['domain'],$community->community_id]) }}">{{ $community->subject }}</a>
							<p class="address">地址：{{ $community->address }}</p>
							<div class="btn">
								<a title="点击查看成功案例" target="_blank" href="http://www.mjbang.cn/xiaoqu/107-anli.html">
									<span class="num"><i class="iconfont"></i>成功案例<em class="text-theme">{{ $community->cases->count() }}</em>套</span>
									<span class="txt">点击查看成功案例</span>
								</a>
								<a title="点击查看正在施工" target="_blank" href="http://www.mjbang.cn/xiaoqu/107-live.html"></a>
							</div>
							<dl>
								<dt>
									<span>装修案例</span>
									<span>风格</span>
									<span>面积</span>
									<span>装修总价</span>
									<span>设计师</span>
									<span> </span>
								</dt>
                    			@foreach ($community->cases->take(2) as $case)
								<dd>
									<span><a href="{{ route('subweb.case.detail',[$case->city['domain'],$case->case_id]) }}">{{ $case->subject }}</a></span>
									<span>中式</span>
									<span>110m²</span>
									<span>8.5万</span>
									<span><a href="{{ route('subweb.designer.detail',[$case->designer->city['domain'],$case->designer->designer_id]) }}">{{ $case->designer->subject }}</a></span>
									<span><a class="yy-btn reserve" data-user-login="0" data-designer-id="17" data-appoint-type="设计师" title="预约参观" href="javascript:;">预约参观</a></span>
								</dd>
                    			@endforeach
							</dl>
						</div>
					</li>
                    @endforeach
                </ul>
            </div>
            {!! $communitys->links() !!}
        </div>
        <div class="sd">
        </div>
    </div>
</div>
@endsection