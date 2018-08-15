@extends('home.layouts.app')

@section('content')
<div class="wp">
    <div id="pt" class="cl">
        <div class="z">
            <span>当前位置：</span>
            <a class="nvhm" href="{{ route('index') }}">快乐装修网</a>
            <em>›</em>
            公司新闻
        </div>
    </div>
    <div class="mod-content mtw mbw">
        <div class="mn">
            <div class="news-list">
                <ul>
                    @foreach ($articles as $article)
                        <li class="cl">
                            <div class="pic">
                                <a href="{{ route('article.detail',$article->article_id) }}" title="{{ $article->subject }}" target="_blank">
                                    <img width="200" height="150" src="{{ route('upload.image', ['id' => $article->upload_image, 'width' => 200, 'height' => 150]) }}" alt="{{ $article->subject }}">
                                </a>
                            </div>
                            <div class="info">
                                <div class="tit"><a href="{{ route('article.detail',$article->article_id) }}" title="{{ $article->subject }}" target="_blank">{{ $article->subject }}</a></div>
                                <div class="time"><span>{{ $article->created_at->format('Y-m-d H:i') }}</span><span>阅读：{{ $article->viewnum }}</span></div>
                                <div class="txt">{{ $article->desc }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            {!! $articles->links() !!}
        </div>
        <div class="sd">
            <div class="sd-news">
                <div class="hd">
                    <h2>热门新闻</h2>
                    <em><a class="more" target="_blank" href="{{ route('article.index') }}">更多 ></a></em>
                </div>
                <div class="bd">
                    <ul>
                        @foreach ($hot_articles as $article)
                        <li class="cl">
                            <div class="pic">
                                <a href="{{ route('article.detail',$article->article_id) }}" title="{{ $article->subject }}" target="_blank">
                                    <img width="80" height="60" src="{{ route('upload.image', ['id' => $article->upload_image, 'width' => 80, 'height' => 60]) }}" alt="{{ $article->subject }}">
                                </a>
                            </div>
                            <div class="tit">
                                <a href="{{ route('article.detail',$article->article_id) }}" title="{{ $article->subject }}" target="_blank">{{ $article->subject }}</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection