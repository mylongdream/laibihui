@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.profile') }}</h3></div>
	</div>
	<div class="mtw">
		<div class="tbedit">
			<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.profile.store') }}">
				{!! csrf_field() !!}
				<table>
					<tr>
						<td width="150" align="right">{{ trans('user.profile.username') }}</td>
						<td>{{auth()->user()->username}}</td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.mobile') }}</td>
						<td>{{auth()->user()->mobile}} <a href="{{ route('user.profile.mobile') }}">修改</a> </td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.realname') }}</td>
						<td><input class="input" type="text" size="50" value="" name="realname"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.email') }}</td>
						<td><input class="input" type="text" size="50" value="" name="email"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.gender') }}</td>
						<td>
                            <label class="radio" for="gender_0"><input value="0" name="gender" id="gender_0" type="radio">保密</label>
                            <label class="radio" for="gender_1"><input value="1" name="gender" id="gender_1" type="radio">男</label>
                            <label class="radio" for="gender_2"><input value="2" name="gender" id="gender_2" type="radio">女</label>
                        </td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.birthday') }}</td>
						<td><input id="birthday" class="input" type="text" size="50" value="" name="birthday" onclick="laydate({max: laydate.now(-1),format:'YYYY-MM-DD'})"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.workarea') }}</td>
						<td>
							<div id="workarea_city">
								<select class="select prov" name="workprovince"></select>
								<select class="select city" name="workcity"></select>
								<select class="select dist" name="workarea"></select>
								<select class="select street" name="workstreet"></select>
							</div>
						</td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.marry') }}</td>
						<td>
							<label class="radio" for="marry_1"><input value="单身" name="marry" id="marry_1" type="radio">单身</label>
							<label class="radio" for="marry_2"><input value="已婚" name="marry" id="marry_2" type="radio">已婚</label>
						</td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.hobby') }}</td>
						<td><input class="input" type="text" size="50" value="" name="hobby"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.stage') }}</td>
						<td>
							<label class="radio" for="stage_1"><input value="少年" name="stage" id="stage_1" type="radio">少年</label>
							<label class="radio" for="stage_2"><input value="青年" name="stage" id="stage_2" type="radio">青年</label>
							<label class="radio" for="stage_3"><input value="中年" name="stage" id="stage_3" type="radio">中年</label>
							<label class="radio" for="stage_4"><input value="老年" name="stage" id="stage_4" type="radio">老年</label>
						</td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.profile.occupation') }}</td>
						<td><input class="input" type="text" size="50" value="" name="occupation"></td>
					</tr>
					<tr>
						<td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">保 存</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
	<script type="text/javascript">
        $("#workarea_city").citySelect({
            url:"{{ route('util.district') }}",
            required:false
        });
	</script>
@endsection