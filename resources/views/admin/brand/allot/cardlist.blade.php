@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.allot') }}</h3></div>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.allot.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th>{{ trans('admin.extend.card.number') }}</th>
				<th width="150">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($cardlist as $card)
			<tr>
				<td>{{ $card->number or '/' }}</td>
				<td>{{ $card->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($cardlist) > 0)
	<div class="pgs cl">
        <div class="page y">
            {!! $cardlist->links() !!}
        </div>
    </div>
	@endif
	</form>
@endsection