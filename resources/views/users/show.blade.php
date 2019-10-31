@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ __('Entries by') }} {{ $user->username }}
                    </h5>
                    <div class="card-body">
                        @include('entries.table')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {{-- React component to handle Twitter API, see `resources/js/` --}}
            <div id="twitter-timeline" data-user="{{ $user->toJson() }}"></div>
        </div>
    </div>
</div>

@endsection