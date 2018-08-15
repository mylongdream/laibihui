@extends('layouts.common.simple')

@section('content')
    @if (!request()->ajax())
        <div class="shop-body">
            @include('brand.shop.header')
            <div class="wp">
                <div class="cl ct_shop mtm">
                    <div class="side">
                        <div class="shop-info">
                            <div class="hd">
                                <span>店铺信息</span>
                            </div>
                            <div class="bd">
                                <dl>
                                    <dt><img width="120" height="120" border="0" src="{{ uploadImage($shop->upimage) }}"></dt>
                                    <dd>{{ $shop->name }}</dd>
                                </dl>
                                <table>
                                    <tr>
                                        <th>分类： </th>
                                        <td>{{ $shop->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>电话： </th>
                                        <td>{{ $shop->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>地址： </th>
                                        <td>{{ $shop->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="shop-sdlist mtm">
                            <div class="hd">
                                <span>最新店铺</span>
                            </div>
                            <div class="bd">
                                <ul>
                                    @foreach ($newshops as $newshop)
                                        <li>
                                            <div class="s-pic"><a href="{{ route('brand.shop.show', $newshop->id) }}" target="_blank" title="{{ $newshop->name }}"><img width="120" height="120" border="0" src="{{ uploadImage($newshop->upimage) }}"></a></div>
                                            <div class="s-info">
                                                <div class="s-name"><a href="{{ route('brand.shop.show', $newshop->id) }}" target="_blank" title="{{ $newshop->name }}">{{ $newshop->name }}</a></div>
                                                <div class="s-address">{{ $newshop->address }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="shop-sdlist mtm">
                            <div class="hd">
                                <span>热门店铺</span>
                            </div>
                            <div class="bd">
                                <ul>
                                    @foreach ($hotshops as $hotshop)
                                        <li>
                                            <div class="s-pic"><a href="{{ route('brand.shop.show', $hotshop->id) }}" target="_blank" title="{{ $hotshop->name }}"><img width="120" height="120" border="0" src="{{ uploadImage($hotshop->upimage) }}"></a></div>
                                            <div class="s-info">
                                                <div class="s-name"><a href="{{ route('brand.shop.show', $hotshop->id) }}" target="_blank" title="{{ $hotshop->name }}">{{ $hotshop->name }}</a></div>
                                                <div class="s-address">{{ $hotshop->address }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main">
                        <div class="shop-tips">
                            <div class="shop-tips-text">
                                <p>亲爱的用户，本店已与知惠网签署合作协议，请您放心消费！</p>
                                <p>如遇商家不给折扣现象，请您当场拨打维权热线！</p>
                                <p>15162882535（小朱）或18862762696（小沈）会帮您及时解决哦~</p>
                            </div>
                        </div>
                        <div class="shop-comment mtm">
                            <div class="hd">
                                <span>顾客点评</span>
                            </div>
                            <div class="bd">
                                <div class="shop-comment-form">
                                    <form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('brand.shop.comment', $shop->id) }}">
                                        {!! csrf_field() !!}
                                        <div class="comment-score">
                                            <dl>
                                                <dt>服务</dt>
                                                <dd><div id="service" class="score-star"></div></dd>
                                            </dl>
                                            <dl>
                                                <dt>环境</dt>
                                                <dd><div id="environment" class="score-star"></div></dd>
                                            </dl>
                                            <dl>
                                                <dt>性价比</dt>
                                                <dd><div id="priceratio" class="score-star"></div></dd>
                                            </dl>
                                        </div>
                                        <div class="comment-box">
                                            <div class="comment-area">
                                                <textarea data-maxlength="300" name="message" placeholder="消费完，不吐不快！别憋着，马上说出来吧！"></textarea>
                                            </div>
                                            @auth
                                            <div class="uploadbox comment-photo">
                                                <ul></ul>
                                            </div>
                                            @endauth
                                            <div class="comment-toolbar">
                                                @auth
                                                <a href="javascript:;" class="upbtn" id="upphoto">上传图片</a>
                                                @endauth
                                                <button class="submitbtn" name="commentsubmit" value="yes" type="submit">发表评论</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="shop-comment-list"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="comment-list-head">
            <h3 class="title">最新评论</h3>
        </div>
        <div class="comment-list-body">
            @if (count($commentlist))
                @foreach ($commentlist as $comment)
                    <div class="comment-item">
                        <div class="comment-content">
                            <div class="comment-user-avatar">
                                <img src="{{ $comment->user && $comment->user->headimgurl ? uploadImage($comment->user->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" border="0">
                            </div>
                            <div class="comment-section">
                                <div class="comment-user-info">
                                    <div class="z">
                                        <span class="comment-user-name">{{ $comment->user ? $comment->user->username : '匿名' }}</span>
                                        <span class="comment-time">{{ $comment->created_at->format('Y-m-d H:i') }}</span>
                                    </div>
                                    <div class="y">
                                        <div class="comment-score">
                                            <span>服务：{{ $comment->service }}分</span>
                                            <span>环境：{{ $comment->environment }}分</span>
                                            <span>性价比：{{ $comment->priceratio }}分</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    {{ $comment->message }}
                                </div>
                                @if ($comment->upphoto)
                                    <div class="comment-photo">
                                        <ul>
                                            @foreach (unserialize($comment->upphoto) as $upphoto)
                                                <li>
                                                    <a href="{{ uploadImage($upphoto) }}" data-lightbox="comment-photo{{ $comment->id }}"><img src="{{ uploadImage($upphoto, ['width'=>70,'height'=>70,'type'=>1]) }}" width="70" height="70" /></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="comment-nodata">
                    <span>暂无评论</span>
                </div>
            @endif
        </div>
        {!! $commentlist->links() !!}
    @endif
@endsection

@section('script')
    <link href="{{ asset('static/js/lightbox2/css/lightbox.min.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/lightbox2/js/lightbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.raty.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $.fn.raty.defaults.path = "{{ asset('static/image/common') }}";
            $('#service').raty({
                scoreName: 'service',
                size     : 24,
                score: 3
            });
            $('#environment').raty({
                scoreName: 'environment',
                size     : 24,
                score: 3
            });
            $('#priceratio').raty({
                scoreName: 'priceratio',
                size     : 24,
                score: 3
            });
            $(".shop-comment-list").load("{{ route('brand.shop.comment', $shop->id) }}").on("click", ".pagination a", function(){
                var self = $(this);
                $(".shop-comment-list").load(self.attr("href"));
                return false;
            });
        });
    </script>
    @auth
    <script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#upphoto").powerWebUpload({
                server: "{{ route('user.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upphoto[]',
                fileNumLimit: 10,
                width: 120,
                height: 120
            });
        });
    </script>
    @endauth
@endsection