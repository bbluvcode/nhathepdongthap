@extends('layouts.admin')

@section('title', 'Carausel Page')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ route('admin.carausels.index') }}">Back to list</a>
        <h1>Create form carausel</h1>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>Info!</strong> {{ session('info') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.carausels.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" name="image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Status:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="check1" name="status" value="1"
                        {{ old('status') ? 'checked' : '' }}>
                    <label class="form-check-label" for="check1">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
