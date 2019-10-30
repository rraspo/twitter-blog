@foreach($entries as $entry)
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <a href="{{ route('entries.show', $entry->id) }}">
                <img src="{{ $entry->image_url }}" onerror="this.onerror=null;this.src='https://picsum.photos/200/200';" class="card-img" alt="{{ $entry->title }}">
            </a>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('entries.show', $entry->id) }}">
                        {{ $entry->title }}
                    </a>
                    @can('update', $entry)
                        <a href="{{ route('entries.edit', $entry->id) }}" class="float-right badge badge-primary">{{ __('Edit') }}</a>
                    @endcan
                    <small class="text-muted">
                        <a class="text-black-50" href="{{ route('users.show', $entry->author) }}">
                            {{ __('by') }} {{ $entry->author->username }}
                        </a>
                    </small>
                </h5>
                <p class="card-text">{{ Illuminate\Support\Str::limit($entry->content, 200, '...') }}</p>
                <p class="card-text"><small class="text-muted">Last updated {{ $entry->created_at->diffForHumans() }}</small></p>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="pagination justify-content-center">
    {{ $entries->links() }}
</div>