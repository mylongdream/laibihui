@extends('layouts.user.app')

@section('content')
    @if (!request()->ajax())
        <div class="itemnav">
            <div class="title"><h3>{{ trans('user.appoint') }}</h3></div>
        </div>
        <div class="mtw">
            <div class="tbhead cl">
                <div class="z"><h3>{{ trans('user.appoint.cancel') }}</h3></div>
            </div>
            <div class="tbedit">
                <div class="order-cancel">
                    <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.appoint.cancel', $appoint->order_sn) }}">
                        {!! csrf_field() !!}
                        <input name="reason" value="" type="hidden" class="cancel-reason">
                        <div class="cancel-tip">
                            <ul>
                                <li><a href="javascript:;">预约信息填写错误</a></li>
                                <li><a href="javascript:;">我想静静</a></li>
                                <li><a href="javascript:;">商家态度差</a></li>
                                <li><a href="javascript:;">太贵了放弃预约</a></li>
                                <li><a href="javascript:;">已经预约了</a></li>
                                <li><a href="javascript:;">不想预约了</a></li>
                            </ul>
                        </div>
                        <div class="cancel-btn">
                            <button value="true" name="submit" type="submit">确认取消</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="order-cancel">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.appoint.cancel', $appoint->order_sn) }}">
                {!! csrf_field() !!}
                <input name="reason" value="" type="hidden" class="cancel-reason">
                <div class="cancel-tip">
                    <ul>
                        <li><a href="javascript:;">预约信息填写错误</a></li>
                        <li><a href="javascript:;">我想静静</a></li>
                        <li><a href="javascript:;">商家态度差</a></li>
                        <li><a href="javascript:;">太贵了放弃预约</a></li>
                        <li><a href="javascript:;">已经预约了</a></li>
                        <li><a href="javascript:;">不想预约了</a></li>
                    </ul>
                </div>
                <div class="cancel-btn">
                    <button value="true" name="submit" type="submit">确认取消</button>
                </div>
            </form>
        </div>
    @endif
@endsection