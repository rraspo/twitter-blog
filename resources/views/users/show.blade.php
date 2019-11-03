@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h5>Welcome to {{ $user->username }}'s profile</h5>
                <div class="row">
                    <div class="col-md-6">
                        {{ $entries->count() }} {{ __('total') }} {{ Str::plural('entry', $entries->count()) }}
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if($entries->count() > 0)
                    <h5 class="card-title">
                        {{ __('Entries by') }} {{ $user->username }}
                    </h5>
                    <div class="card-body">
                        @include('entries.table')
                    </div>
                    @else
                    <h5 class="card-title">
                        {{ __('No entries yet, ') }} <a href="{{ route('entries.create') }}">{{ __('create one') }}</a>
                    </h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {{-- React component to handle Twitter API, see `resources/js/` --}}
            <div id="twitter-timeline" data-user="{{ $user->toJson() }}" data-autheduser="{{ Auth::user()->id ?? '' }}"></div>
        </div>
    </div>
</div>

@endsection