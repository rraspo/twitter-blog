@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $entry->title }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-fluid" src="{{ $entry->image_url }}" alt="{{ $entry->title }}" />
                        </div>
                        <div class="col-md-8">
                            <p>
                                {{ $entry->content }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{ __('Submitted by') }} <a href="{{ route('users.show', $entry->author->id) }}">{{ $entry->author->username }}</a> {{ $entry->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection