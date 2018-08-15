@extends('home.layouts.app')

@section('content')
<div class="wp">
    <div class="mod-title cl">
        <div class="z">家装案例</div>
        <p>如果你不知道怎么装修，来看看这里</p>
    </div>
    <div class="mod-content cl">
        <div class="mn">
            <div class="mod-activitylist cl">
                <ul>
                    @foreach ($activitys as $activity)
                    <li><a href="{{ route('activity.detail',$activity->hashid) }}">{{ $activity->subject }}</a></li>
                    @endforeach
                </ul>
            </div>
            {!! $activitys->links() !!}
        </div>
        <div class="sd">
        </div>
    </div>
</div>
@endsection