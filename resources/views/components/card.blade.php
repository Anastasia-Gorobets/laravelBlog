<div class="card" style="width: 100%">
    <div class="card-body">
        <div class="card-title">
           {{ $title }}
        </div>
        <div class="card-subtitle mb-2 text-muted">
            <h6>{{ $subtitle }}</h6>
        </div>
        <ul class="list-group list-group-flush">
            @if(is_a($items,'Illuminate\Support\Collection'))
                @foreach($items as $item)
                    <li class="list-group-item">
                        {{$item}}
                    </li>
                @endforeach
            @else
                {{$items}}
            @endif
        </ul>
    </div>
</div>
