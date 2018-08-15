@extends('home.layouts.simple')

@section('content')
<div class="wp">
    <div class="all-subweb">
        <div class="jump">
            <a href="">点击进入杭州站>></a>
        </div>
        <div class="main">
            <div class="top-map">
                <div class="hot-subweb">
                    <dl class="cl">
                        <dt><span>热门城市</span></dt>
                        <dd>
                            @foreach ($hotsubwebs as $hotsubweb)
                            <a href="{{ route('subweb.index',$hotsubweb->directory) }}">{{ $hotsubweb->name }}</a>
                            @endforeach
                        </dd>
                    </dl>
                </div>
                <div class="select-search">
                    <dl class="cl">
                        <dt><span>快速查找</span></dt>
                        <dd>
                            <select name="province_id" id="province_id" class="select select_province"></select>
                            <select name="subweb_id" id="subweb_id" class="select select_subweb"></select>
                            <button class="submitbtn" type="submit" value="yes" name="updatesubmit">进入</button>
                        </dd>
                    </dl>
                </div>
                <div class="mapbg"></div>
            </div>
            <div class="letter-order">
                <span>按拼音首字母选择</span>
            </div>
            <div class="subweb-box">
                @foreach (range('A','Z') as $letter)
                @if (isset($allsubwebs[$letter]))
                <dl class="cl">
                    <dt><span>{{ $letter }}</span></dt>
                    <dd>
                        @foreach ($allsubwebs[$letter] as $subweb)
                            @if ($subweb->ifhot)
                                <a href="{{ route('subweb.index',$subweb->directory) }}" class="text-red">{{ $subweb->name }}</a>
                            @else
                                <a href="{{ route('subweb.index',$subweb->directory) }}">{{ $subweb->name }}</a>
                            @endif
                        @endforeach
                    </dd>
                </dl>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection