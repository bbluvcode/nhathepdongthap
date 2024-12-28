@extends('layouts.admin')

@section('title', 'Post admin Page')

@section('content')
    <div class="container mt-2">
        <a class="btn btn-primary" href="{{ route('admin.tvgs.index') }}">Danh sach post TVGS</a>
        <a class="btn btn-primary" href="{{ route('admin.tvgs.index') }}">Danh sach post Tin Tuc</a>
        <h1>Update form post</h1>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>Info!</strong> {{ session('info') }}
            </div>
        @endif
        <divc class="row">
            <div class="col-md-10">
                <form method="POST" action="{{ route('admin.post.updatePost',$news) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control"
                        placeholder="nhập title bài báo" value="{{ old('title',$news->title) }}" name="title">
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
                        <img src="{{ $news->image }}" width="100" class="img-thumbnail" />
                        <input type="hidden" value="{{ $news->image }}" class="form-control" name="imageExisted">
                    </div>
                    <div class="mb-3 mt-3">
                        <select class="form-select" name="type">
                            <option value="">===CHON KIỂU BAI POST===</option>
                            <option value="TVGS" @selected(old('type',$news->type)=="TVGS")>TƯ VẤN GIÁM SÁT</option>
                            <option value="NEWS" @selected(old('type',$news->type)=="NEWS")>TIN TỨC</option>
                            <option value="TVGSAT" @selected(old('type',$news->type)=="TVGSAT")>TƯ VẤN GIÁM SÁT ẤN TƯỢNG</option>
                          </select>
                        @error('type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="image" class="form-label">Description:</label>
                        <textarea name="description"  id="description"  class="form-control" cols="30" rows="10">{{ old('description',$news->description) }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
         
        </div>
    
    </div>
    <script>
        $('#description').summernote({
            tabsize: 2,
            height: 300,
            callbacks: {
                onMediaDelete: function(target) {
                    let deletedImages = $('#deleted_images').val();
                    deletedImages = deletedImages ? JSON.parse(deletedImages) : [];
                    console.log("target[0].src: ",target[0].src);
                    deletedImages.push(target[0].src);
                    $('#deleted_images').val(JSON.stringify(deletedImages));
                }
            }
        });
    </script>
@endsection
