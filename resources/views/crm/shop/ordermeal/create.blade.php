@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li><a href="{{ route('crm.ordermeal.index') }}">自助点餐明细</a></li>
            <li class="on"><a href="{{ route('crm.ordermeal.create') }}">我要点餐</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.ordermeal.store') }}">
            {!! csrf_field() !!}
            <div class="crm-list">
                <table>
                    @if ($meallist->where('catid', 0)->count())
                        <tr>
                            <th align="left"></th>
                            <th colspan="3" align="left"><span style="color: #999">默认分类</span></th>
                        </tr>
                        @foreach ($meallist->where('catid', 0) as $value)
                            <tr>
                                <td width="20"><input class="ids" value="{{ $value->id }}" name="ids[]" type="checkbox"></td>
                                <td>{{ $value->name }}</td>
                                <td width="120">￥{{ $value->price }}</td>
                                <td width="120">
                                    <div class="choose-amount">
                                        <span class="cut_num"></span>
                                        <input class="key_num" type="text" value="1" name="amount[{{ $value->id }}]" size="6" maxlength="6" data-max="100">
                                        <span class="add_num"></span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @foreach (auth('crm')->user()->shop->mealcategory as $mealcategory)
                        @if ($meallist->where('catid', $mealcategory->id)->count())
                            <tr>
                                <th align="left"></th>
                                <th colspan="3" align="left"><span style="color: #999">{{ $mealcategory->name }}</span></th>
                            </tr>
                            @foreach ($meallist->where('catid', $mealcategory->id) as $value)
                                <tr>
                                    <td width="20"><input class="ids" value="{{ $value->id }}" name="ids[]" type="checkbox"></td>
                                    <td>{{ $value->name }}</td>
                                    <td width="120">￥<span class="meal-price">{{ $value->price }}</span></td>
                                    <td width="120">
                                        <div class="choose-amount">
                                            <span class="cut_num"></span>
                                            <input class="key_num" type="text" value="1" name="amount[{{ $value->id }}]" size="6" maxlength="6" data-max="100">
                                            <span class="add_num"></span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </table>
            </div>
            <div class="bd crm-form">
                <table>
                    <tr>
                        <td width="150" align="right">结算总额</td>
                        <td>￥<span id="totalPrice">0</span></td>
                    </tr>
                    <tr>
                        <td align="right">用户账户</td>
                        <td><input class="input" type="text" size="50" value="" name="account" placeholder=""></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">其它要求</td>
                        <td><textarea class="textarea" name="remark" cols="60" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".ids", function(){
                totalPrice();
            });
            $(document).on("change", ".choose-amount .key_num", function(){
                var self = $(this);
                var value = self.val();
                if (self.parents('tr').find(".ids").is(':checked')) {
                    totalPrice();
                }
            });
            function totalPrice(){
                var totalPrice = price = amount = 0;
                $(".ids").each(function(i){
                    if(this.checked){
                        price = parseInt($(this).parents('tr').find(".meal-price").text() * 100, 10);
                        amount = parseInt($(this).parents('tr').find(".key_num").val(), 10) || 1;
                        totalPrice += price * amount;
                    }
                });
                $("#totalPrice").text(totalPrice / 100);
            }
        });
    </script>
@endsection