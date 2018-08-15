@extends('layouts.crm.app')

@section('content')
    @if (!request()->ajax())
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>新增卡号</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.shop.addcard', ['id' => $shop->id, 'allotid' => request('allotid')]) }}">
                    {!! csrf_field() !!}
                    <table>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td>{{ $shop->name }}</td>
                        </tr>
                    <tr>
                        <td align="right">剩余分配</td>
                        <td><span class="cardsurplus">{{ $allot->quantity - $allot->cardlist->count() }}</span> 张</td>
                    </tr>
                        <tr>
                            <td align="right" valign="top">分配卡号</td>
                            <td>
                        <textarea class="textarea" name="number" cols="60" rows="6" id="cardnumber"></textarea>
						<div class="tdtip mtm">每行一个卡号</div>
						</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    @else
        <div class="crm-form">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('crm.shop.addcard', ['id' => $shop->id, 'allotid' => request('allotid')]) }}">
                {!! csrf_field() !!}
                <table>
                    <tr>
                        <td width="150" align="right">商户名称</td>
                        <td width="450">{{ $shop->name }}</td>
                    </tr>
                    <tr>
                        <td align="right">剩余分配</td>
                        <td><span class="cardsurplus">{{ $allot->quantity - $allot->cardlist->count() }}</span> 张</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">分配卡号</td>
                        <td>
                            <textarea class="textarea" name="number" cols="60" rows="6" id="cardnumber"></textarea>
                            <div class="tdtip mtm">每行一个卡号</div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                    </tr>
                </table>
            </form>
        </div>
    @endif
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $("#cardnumber").keydown(function(event) {
                if (event.keyCode == "13") {
                    var text = $(this).val();
                    var arry = text.split("\n");
                    if (arry.length > parseInt($(".cardsurplus").text(), 10)) {
					    alert('超出剩余分配数量');
                    }
                    var number = arry[arry.length-1];
                    $.ajax({
                        type: "GET",
                        url: "{{ route('crm.shop.checkcard') }}",
                        data: {number: number},
                        async:false
                    }).success(function(data) {
                        if(data.status == 0){
                            alert(data.info);
                        }
                    }).error(function(data) {
                        if (!data) {
                            return true;
                        } else {
                            message = $.parseJSON(data.responseText);
                            $.each(message.errors, function (key, value) {
                                alert(value);
                                return false;
                            });
                            return false;
                        }
                    });
                }
            });
        });
    </script>
@endsection