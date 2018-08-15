@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.card') }}</h3></div>
	</div>
	<form class="ajaxforms" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.card.export') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.card.export') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.card.index') }}" class="btn">< {{ trans('admin.extend.card.list') }}</a></div>
			</div>
			<table>
                <tr>
                    <td width="150" align="right">{{ trans('admin.extend.card.ifbind') }}</td>
                    <td>
                        <select class="select" name="bind">
                            <option value="0">未绑定</option>
                            <option value="1">已绑定</option>
							<option value="2">被分配</option>
                        </select>
                    </td>
                </tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.card.prefix') }}</td>
					<td><input class="txt" type="text" size="30" value="" name="prefix"><span class="tdtip">可以填写如区号：0571</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.card.count') }}</td>
					<td><input class="txt" type="text" size="30" value="1" name="count"><span class="tdtip">最多可以导出10000张</span></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="批量导出" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection