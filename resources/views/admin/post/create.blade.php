@extends('layouts.admin')

@section('title', 'Post admin Page')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ route('admin.tvgs.index') }}">Danh sach post TVGS</a>
        <a class="btn btn-primary" href="{{ route('admin.tvgs.index') }}">Danh sach post Tin Tuc</a>
        <h1>Create form post</h1>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>Info!</strong> {{ session('info') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control"
                placeholder="nhập title bài báo" value="{{ old('title') }}" name="title">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" name="image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <select class="form-select" name="type">
                    <option value="">===CHON KIỂU BAI POST===</option>
                    <option value="TVGS" @selected(old('type')=="TVGS")>TƯ VẤN GIÁM SÁT</option>
                    <option value="NEWS" @selected(old('type')=="NEWS")>TIN TỨC</option>
                    <option value="TVGSAT" @selected(old('type')=="TVGSAT")>TƯ VẤN GIÁM SÁT ẤN TƯỢNG</option>
                  </select>
                @error('type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="image" class="form-label">Description:</label>
                <textarea name="description"  id="description"  class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        $('#description').summernote({
            tabsize: 2,
            height: 300
        });
        let markupStr = $('#summernote').summernote('code');
    </script>
@endsection
