@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.address') }}</h3></div>
		<ul class="tab">
			<li class="on"><a href="{{ route('user.address.index') }}"><span>{{ trans('user.address.list') }}</span></a></li>
			<li><a href="{{ route('user.address.create') }}"><span>{{ trans('user.address.create') }}</span></a></li>
		</ul>
	</div>
    <div class="extra-info mtw">
        已保存了 {{ auth()->user()->addresses->count() }} 条收货地址，你还能保存 {{ $address_maxnum - auth()->user()->addresses->count() }} 条收货地址
    </div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left" width="80">{{ trans('user.address.realname') }}</th>
				<th align="left" width="180">{{ trans('user.address.area') }}</th>
				<th align="left">{{ trans('user.address.address') }}</th>
				<th align="center" width="80">{{ trans('user.address.zipcode') }}</th>
				<th align="center" width="100">{{ trans('user.address.mobile') }}</th>
				<th align="center" width="80">{{ trans('user.operation') }}</th>
			</tr>
			@if (count($addresses))
				@foreach ($addresses as $value)
					<tr>
						<td align="left">{{ $value->realname }}</td>
						<td align="left">{{ $value->getprovince ? $value->getprovince->name : '' }}{{ $value->getcity ? $value->getcity->name : '' }}{{ $value->getarea ? $value->getarea->name : '' }}{{ $value->getstreet ? $value->getstreet->name : '' }}</td>
						<td align="left">{{ $value->address }}</td>
						<td align="center">{{ $value->zipcode }}</td>
						<td align="center">{{ $value->mobile }}</td>
						<td align="center">
							<a href="{{ route('user.address.edit',$value->id) }}" class="" title="{{ trans('admin.article.edit') }}">{{ trans('admin.edit') }}</a>
							<a href="{{ route('user.address.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6" class="nodata">暂无数据</td>
				</tr>
			@endif
		</table>
	</div>
@endsection