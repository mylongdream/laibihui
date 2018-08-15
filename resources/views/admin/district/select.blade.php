<option value="0">请选择区域</option>
@foreach ($areas as $area)
    @if ($area->current)
        <option value="{{ $area->area_id }}" selected>{{ $area->area_name }}</option>
    @else
        <option value="{{ $area->area_id }}">{{ $area->area_name }}</option>
    @endif
@endforeach
