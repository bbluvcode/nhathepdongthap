@extends('layouts.admin')
@section('title', 'Carausel Page')
@section('content')
    <div class="container">
        <h1 class="text-center bg-primary">VIDEO INTRO</h1>
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Info!</strong> {{ session('success') }}
                    </div>
                @endif
                @if ($introMovie)
                    <form method="POST" action="{{ route('admin.updateVideoIntro', $introMovie) }}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" value="{{ old('title', $introMovie->title) }}"
                                name="title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" rows="10" name="description">{{ old('description', $introMovie->description) }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Url Video:</label>
                            <input type="text" class="form-control" placeholder="nhập url video"
                                value="{{ old('urlVideo', $introMovie->urlVideo) }}" name="urlVideo">
                            @error('urlVideo')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.storeVideoIntro') }}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" name="title" value={{ old('title') }}>
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Description:</label>
                            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Url Video:</label>
                            <input type="text" class="form-control" placeholder="nhập url video" name="urlVideo">
                            @error('urlVideo')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                @endif
            </div>
            <div class="col-md-4">
                <img class="w-100" src="https://t3.ftcdn.net/jpg/04/69/30/86/360_F_469308670_QhXiy9YO5TknRN0iL74S4LRBSVvkMbRZ.jpg"/>
            </div>
        </div>


    </div>

@endsection
