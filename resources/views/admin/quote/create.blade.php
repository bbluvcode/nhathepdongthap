@extends('layouts.admin')

@section('title', 'Carausel Page')

@section('content')
    <div class="container p-5">
        <a class="btn btn-primary" href="{{ route('admin.quote.index') }}">Back to list</a>
        <h1>Create form Quote</h1>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>Info!</strong> {{ session('info') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.quote.store') }}">
            @csrf
            <div class="mb-3 mt-3">
                <label for="author" class="form-label">Author:</label>
                <input type="text" class="form-control" name="author">
                @error('author')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="" cols="30" rows="10" name="description"></textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="type" class="form-label">Page hiển thị:</label>
                <select class="form-select" name="type">
                    <option value="">===CHON PAGE HIỂN THỊ===</option>
                    <option value="TVGS" @selected(old('type')=="TVGS")>TƯ VẤN GIÁM SÁT</option>
                    <option value="DUAN" @selected(old('type')=="DUAN")>DỰ ÁN</option>
                  </select>
                @error('type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
