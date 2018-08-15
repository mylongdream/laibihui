<option value="0">请选择城市</option>
@foreach ($citys as $city)
    @if ($city->current)
        <option value="{{ $city->city_id }}" selected>{{ $city->city_name }}</option>
    @else
        <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
    @endif
@endforeach
