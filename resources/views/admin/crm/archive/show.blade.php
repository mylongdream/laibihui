@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.archive') }}</h3></div>
	</div>
	<div class="tbedit">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.crm.archive.show') }}</h3></div>
			<div class="y">
                @if ($archive->status == 0)
                    <a href="{{ route('admin.crm.archive.edit',$archive->id) }}" class="btn openwindow" title="审核">点击审核</a>
                @else
                    <div style="font-size: 18px;line-height: 42px;height: 42px;color:#f00;margin-right: 15px;">{{ trans('admin.crm.archive.status_'.$archive->status) }}</div>
                @endif
            </div>
		</div>
		<table>
			<tr>
				<td width="150" align="right">{{ trans('admin.brand.shop.name') }}</td>
				<td>{{ $archive->shop->name }}</td>
			</tr>
			<tr>
				<td align="right">{{ trans('admin.brand.shop.upphoto') }}</td>
				<td>
					<div class="uploadbox">
						<ul>
							@if ($archive->upphoto)
								@foreach (unserialize($archive->upphoto) as $upphoto)
									<li>
										<img src="{{ uploadImage($upphoto) }}" width="120" height="120">
									</li>
								@endforeach
							@endif
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<td align="right">{{ trans('admin.brand.shop.message') }}</td>
				<td>
					<div style="word-wrap:break-word;word-break:break-all;width:100%;overflow:hidden">
						{!! $archive->message !!}
					</div>
				</td>
			</tr>
		</table>
	</div>
@endsection