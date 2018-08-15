@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.address') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.address.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.user.address.mobile') }}</dt>
			<dd><input type="text" name="mobile" class="schtxt" value="{{ request('mobile') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.address.index') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.address.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.user.address.create') }}" class="btn">+ {{ trans('admin.user.address.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><label><input class="checkall" type="checkbox"></label></th>
				<th width="80">{{ trans('admin.user.address.realname') }}</th>
				<th width="180">{{ trans('admin.user.address.area') }}</th>
				<th>{{ trans('admin.user.address.address') }}</th>
				<th width="80">{{ trans('admin.user.address.zipcode') }}</th>
				<th width="100">{{ trans('admin.user.address.mobile') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($addresslist as $address)
			<tr>
				<td><label><input class="ids" type="checkbox" value="{{ $address->id }}" name="ids[]"></label></td>
				<td>{{ $address->realname }}</td>
				<td>{{ $address->getprovince ? $address->getprovince->name : '' }}{{ $address->getcity ? $address->getcity->name : '' }}{{ $address->getarea ? $address->getarea->name : '' }}{{ $address->getstreet ? $address->getstreet->name : '' }}</td>
				<td>{{ $address->address }}</td>
				<td>{{ $address->zipcode }}</td>
				<td>{{ $address->mobile }}</td>
				<td>{{ $address->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.user.address.edit',$address->id) }}" class="">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.user.address.destroy',$address->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($addresslist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $addresslist->appends(['mobile' => request('mobile')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection