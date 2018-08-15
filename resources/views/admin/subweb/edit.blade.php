@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.subweb') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.subweb.update', $subweb->subweb_id) }}">
		<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span>{{ trans('admin.info_base') }}</span></li>
						<li><span>{{ trans('admin.info_seo') }}</span></li>
					</ul>
				</div>
				<div class="y"><a href="{{ route('admin.subweb.index') }}" class="btn">< {{ trans('admin.subweb.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="120" align="right">{{ trans('admin.subweb.city') }}</td>
					<td>
						<div id="address_city">
							<select class="select prov" name="province"></select>
							<select class="select city" name="city"></select>
						</div>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.subweb.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->name }}" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.subweb.fullletter') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->fullletter }}" name="fullletter"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.subweb.firstletter') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->firstletter }}" name="firstletter" maxlength="1" style="text-transform: uppercase;"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.subweb.directory') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->directory }}" name="directory"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.subweb.domain') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->domain }}" name="domain"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.subweb.mappoint') }}</td>
					<td><input class="txt" type="text" size="29" value="{{ $subweb->mappoint }}" name="mappoint" id="mappoint"><a href="javascript:;" class="mapmark" id="mapmark">点击标注</a></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.subweb.statcode') }}</td>
					<td><textarea class="textarea" name="statcode" cols="60" rows="5">{{ $subweb->statcode }}</textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->displayorder }}" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.subweb.ifhot') }}</td>
					<td>
						<label class="radio" for="ifhot_1">
							<input id="ifhot_1" type="radio" name="ifhot" value="1" {{ $subweb['ifhot'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="ifhot_0">
							<input id="ifhot_0" type="radio" name="ifhot" value="0" {{ $subweb['ifhot'] ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.subweb.bbclosed') }}</td>
					<td>
						<label class="radio" for="bbclosed_1">
							<input id="bbclosed_1" type="radio" name="bbclosed" value="1" {{ $subweb['bbclosed'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="bbclosed_0">
							<input id="bbclosed_0" type="radio" name="bbclosed" value="0" {{ $subweb['bbclosed'] ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->seo_title }}" name="seo_title"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="{{ $subweb->seo_keywords }}" name="seo_keywords"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_description</td>
					<td><textarea class="textarea" name="seo_description" cols="60" rows="5">{{ $subweb->seo_description }}</textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.amap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#address_city").citySelect({
                url:"{{ route('util.district') }}",
                required:false,
                prov:"{{ $subweb->district->upid }}",
                city:"{{ $subweb->district_id }}"
            });
            $("#mapmark").amap({
                InputId: '#mappoint',
                width: 800,
                height: 500
            });
        });
	</script>
@endsection