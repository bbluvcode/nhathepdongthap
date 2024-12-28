@extends('layouts.admin')
@section('title', 'Carausel Page')
<style>
    .text-description {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* number of lines to show */
        line-clamp: 1;
        -webkit-box-orient: vertical;
    }
</style>
@section('content')
    <div class="container">
        <h1 class="text-center bg-primary">AC Outstandings</h1>
        <div class="row">
            <div class="col-md-7">
                <table class="table knowtable">
                    <h1>Danh Sach Outstandings</h1>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outstandings as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td><img src="{{$item->image}}" class="img-thumbnail" width="100"></td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.outstanding.edit', $item->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    {{-- <a class="btn btn-danger" href="{{ route('admin.panelJob.delete', $item->id) }}"><i
                                            class="fa-solid fa-trash"></i></a>
                                    <a class="btn btn-info" href="{{ route('admin.panelJob.detail', $item->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                 --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <h1>Create form Outstanding</h1>
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>Info!</strong> {{ session('info') }}
                    </div>
                @endif
                @if ($outstanding)
                    <form method="POST" 
                    enctype='multipart/form-data'
                    action="{{ route('admin.outstanding.update', $outstanding) }}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" name="title" value="{{ $outstanding->title }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Current Image:</label>
                            <input type="hidden" value="{{ $outstanding->image }}" name="imageExisting">
                           <img src="{{$outstanding->image}}" width="100" class="img-thumbnail">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Image:</label>
                        
                            <input type="file" class="form-control" name="image" value="{{ $outstanding->image }}">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1" name="status" value="1"
                                    {{ old('status', $outstanding->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="check1">Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a type="cancel" class="btn btn-warning"
                            href="{{ route('admin.form.cancel', $outstanding->id) }}">Cancel</a>
                    </form>
                @else
                <form method="POST" 
                enctype='multipart/form-data'
                action="{{ route('admin.outstanding.create') }}">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" name="title" value="{{ old("title") }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" class="form-control" name="image" >
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
                @endif

            </div>
        </div>
    </div>
@endsection
