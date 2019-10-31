@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit entry') }}
                    <div class="float-right">
                        <form action="{{ route('entries.destroy', $entry->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">{{ __('Delete entry') }}</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('entries.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-10 offset-md-1">
                                <img src="{{ $entry->image_url }}" class="img-fluid" alt="{{ $entry->title }}" onerror="this.onerror=null;this.src='https://picsum.photos/200/200';" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $entry->title }}" required autofocus />

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10" required>{{ $entry->content }}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_url" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image_url" type="text" class="form-control @error('image_url') is-invalid @enderror" name="image_url" value="{{ $entry->image_url }}" autofocus />
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection