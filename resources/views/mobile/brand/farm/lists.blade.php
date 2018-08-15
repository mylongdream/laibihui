@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="weui-search-bar" id="searchBar">
                            <form class="weui-search-bar__form" action="{{ route('mobile.brand.farm.index') }}">
                                <div class="weui-search-bar__box">
                                    <i class="weui-icon-search"></i>
                                    <input type="search" class="weui-search-bar__input" name="keyword" value="{{ request('keyword') }}" placeholder="搜索">
                                    <a href="javascript:" class="weui-icon-clear"></a>
                                </div>
                                <label class="weui-search-bar__label">
                                    <i class="weui-icon-search"></i>
                                    <span>搜索</span>
                                </label>
                            </form>
                            <a href="javascript:" class="weui-search-bar__cancel-btn">取消</a>
                        </div>
                        @if (count($farmlist))
                            @if (request('style') == 'grid')
                                <div class="farm-grid">
                                    <ul class="cl">
                                        @foreach ($farmlist as $value)
                                            <li>
                                                <div class="s-box">
                                                    <div class="s-pic"><a href="{{ route('mobile.brand.farm.show', $value->id) }}" target="_blank" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                                                    <div class="s-name"><a href="{{ route('mobile.brand.farm.show', $value->id) }}" target="_blank" title="{{ $value->name }}">{{ $value->name }}</a></div>
                                                    <div class="s-discount">
                                                        <span class="s-discount1"><em>￥</em><strong>{{ $value->price }}</strong>元</span>
                                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="farm-list">
                                    <ul class="cl">
                                        @foreach ($farmlist as $value)
                                            <li>
                                                <a href="{{ route('mobile.brand.farm.show', $value->id) }}" title="{{ $value->name }}">
                                                    <div class="s-pic"><img src="{{ uploadImage($value->upimage) }}"></div>
                                                    <div class="s-info">
                                                        <div class="s-name">{{ $value->name }}</div>
                                                        <div class="s-address">地址：{{ $value->address }}</div>
                                                        <div class="s-discount">
                                                            <label>尊享标牌价：</label>
                                                        <span class="s-discount1"><em>￥</em><strong>{{ $value->price }}</strong>元</span>
                                                            <span class="s-discount2"><del>原价靠边站</del></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {!! $farmlist->appends(['name' => request('name')])->appends(['style' => request('style')])->links() !!}
                        @else
                            <div class="no-data">
                                <p>暂无该折扣的优惠信息！</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.mobile.footer')
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        weui.searchBar('#searchBar');
    </script>
@endsection
