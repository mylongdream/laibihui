@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.redpack') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.redpack.update', $redpack->id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.redpack.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.redpack.index') }}" class="btn">< {{ trans('admin.extend.redpack.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.redpack.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $redpack->name }}" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.redpack.amount') }}</td>
					<td><input class="txt" type="text" size="30" value="{{ $redpack->amount }}" name="amount"> 元</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.redpack.fullamount') }}</td>
					<td><input class="txt" type="text" size="30" value="{{ $redpack->fullamount }}" name="fullamount"> 元</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.extend.redpack.use_time') }}</td>
					<td><input id="starttime" class="txt" type="text" size="20" value="{{ $redpack->use_start }}" name="use_start"> 至 <input id="endtime" class="txt" type="text" size="20" value="{{ $redpack->use_end }}" name="use_end"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.redpack.remark') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $redpack->remark }}" name="remark"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            laydate({
                elem: '#starttime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
            });
            laydate({
                elem: '#endtime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
            });
        });
	</script>
@endsection