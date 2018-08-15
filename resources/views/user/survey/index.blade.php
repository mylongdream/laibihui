@extends('layouts.common.simple')

@section('content')
    <div class="content-body">
        <div class="wp">
            <div class="container-box cl">
                <div class="survey-box">
                    <div class="survey-tit">
                        <h1>知惠网用户调研问卷</h1>
                    </div>
                    <div class="survey-desc">
                        <span>您好，我们正在进行一项关于知惠网用户的调查，想邀请您用几分钟时间帮忙填答这份问卷。本问卷所有数据只用于统计分析， 请您放心填写。下面我们列出一系列问题，请您按自己的实际情况认真填写。填完赠送您20积分！</span>
                    </div>
                    <div class="survey-form">
                        <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.survey.store') }}">
                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!}
                            <dl>
                                <dt>1、您的性别是？<span class='required'>*</span></dt>
                                <dd>
                                    <label class="radio" for="gender_1"><input value="1" name="gender" id="gender_1" type="radio" checked>男</label>
                                    <label class="radio" for="gender_2"><input value="2" name="gender" id="gender_2" type="radio" >女</label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>2、您的出生日期是？<span class='required'>*</span></dt>
                                <dd><input class="input" type="text" size="50" value="" name="birthday"></dd>
                            </dl>
                            <dl>
                                <dt>3、您的工作地区是？<span class='required'>*</span></dt>
                                <dd>
                                    <div id="address_city">
                                        <select class="select prov" name="province"></select>
                                        <select class="select city" name="city"></select>
                                        <select class="select dist" name="area"></select>
                                        <select class="select street" name="street"></select>
                                    </div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>4、您的婚姻状况是？<span class='required'>*</span></dt>
                                <dd>
                                    <label class="radio" for="marry_1"><input value="单身" name="marry" id="marry_1" type="radio" >单身</label>
                                    <label class="radio" for="marry_2"><input value="已婚" name="marry" id="marry_2" type="radio" >已婚</label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>5、您的爱好是？<span class='required'>*</span></dt>
                                <dd><input class="input" type="text" size="50" value="" name="hobby"></dd>
                            </dl>
                            <dl>
                                <dt>6、您正处在哪个阶段？<span class='required'>*</span></dt>
                                <dd>
                                    <label class="radio" for="stage_1"><input value="少年" name="stage" id="stage_1" type="radio" >少年</label>
                                    <label class="radio" for="stage_2"><input value="青年" name="stage" id="stage_2" type="radio" >青年</label>
                                    <label class="radio" for="stage_3"><input value="中年" name="stage" id="stage_3" type="radio" >中年</label>
                                    <label class="radio" for="stage_4"><input value="老年" name="stage" id="stage_4" type="radio" >老年</label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>7、您的工作是？<span class='required'>*</span></dt>
                                <dd><input class="input" type="text" size="50" value="" name="job"></dd>
                            </dl>
                            <div class="survey-submit">
                                <button value="true" name="savesubmit" type="submit" class="button">确认提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#address_city").citySelect({
                url:"{{ route('util.district') }}",
                required:false
            });
        });
    </script>
@endsection