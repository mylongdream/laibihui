@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.profile') }}</h3></div>
	</div>
	<div class="mtw">
		<div class="tbedit">
			<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.profile.update') }}">
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
				<table>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.username') }}</td>
						<td>{{auth()->user()->username}}</td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.mobile') }}</td>
						<td>{{auth()->user()->mobile}}</td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.realname') }}</td>
						<td><input class="input" type="text" size="50" value="{{$profile->realname}}" name="realname"></td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.email') }}</td>
						<td><input class="input" type="text" size="50" value="{{$profile->email}}" name="email"></td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.gender') }}</td>
						<td>
                            <label class="radio" for="gender_0"><input value="0" name="gender" id="gender_0" type="radio" {{ $profile->gender == 0 ? 'checked' : '' }}>保密</label>
                            <label class="radio" for="gender_1"><input value="1" name="gender" id="gender_1" type="radio" {{ $profile->gender == 1 ? 'checked' : '' }}>男</label>
                            <label class="radio" for="gender_2"><input value="2" name="gender" id="gender_2" type="radio" {{ $profile->gender == 2 ? 'checked' : '' }}>女</label>
                        </td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.birthday') }}</td>
						<td><input id="birthday" class="input" type="text" size="50" value="{{$profile->birthday ? $profile->birthday->format('Y-m-d') : ''}}" name="birthday" onclick="laydate({format:'YYYY-MM-DD'})"></td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.workarea') }}</td>
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
						<td width="120" align="right">{{ trans('user.profile.marry') }}</td>
						<td>
							<label class="radio" for="marry_1"><input value="单身" name="marry" id="marry_1" type="radio" {{ $profile->marry == "单身" ? 'checked' : '' }}>单身</label>
							<label class="radio" for="marry_2"><input value="已婚" name="marry" id="marry_2" type="radio" {{ $profile->marry == "已婚" ? 'checked' : '' }}>已婚</label>
						</td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.hobby') }}</td>
						<td><input class="input" type="text" size="50" value="{{$profile->hobby}}" name="hobby"></td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.stage') }}</td>
						<td>
							<label class="radio" for="stage_1"><input value="少年" name="stage" id="stage_1" type="radio" {{ $profile->stage == "少年" ? 'checked' : '' }}>少年</label>
							<label class="radio" for="stage_2"><input value="青年" name="stage" id="stage_2" type="radio" {{ $profile->stage == "青年" ? 'checked' : '' }}>青年</label>
							<label class="radio" for="stage_3"><input value="中年" name="stage" id="stage_3" type="radio" {{ $profile->stage == "中年" ? 'checked' : '' }}>中年</label>
							<label class="radio" for="stage_4"><input value="老年" name="stage" id="stage_4" type="radio" {{ $profile->stage == "老年" ? 'checked' : '' }}>老年</label>
						</td>
					</tr>
					<tr>
						<td width="120" align="right">{{ trans('user.profile.occupation') }}</td>
						<td><input class="input" type="text" size="50" value="{{$profile->occupation}}" name="occupation"></td>
					</tr>
					<tr>
						<td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
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
            required:false,
            prov:"{{ $profile->workprovince }}",
            city:"{{ $profile->workcity }}",
            dist:"{{ $profile->workarea }}",
            street:"{{ $profile->workstreet }}"
        });
	</script>
@endsection