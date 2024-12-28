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
        <h1 class="text-center bg-primary">AC Feedbacks</h1>
        <div class="row">
            <div class="col-md-7">
                <table class="table knowtable">
                    <h3>Danh Sach Feedbacks</h3>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td><span class="text-description">{{ $item->description }}</span></td>
                                <td><img src="{{$item->image}}" class="img-thumbnail" width="100"></td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.feedback.edit', $item->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="btn btn-danger" href="{{ route('admin.feedback.delete', $item->id) }}"><i
                                            class="fa-solid fa-trash"></i></a>
                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <h3>Create form Feedback</h3>
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>Info!</strong> {{ session('info') }}
                    </div>
                @endif
                @if ($feedback)
                    <form method="POST" 
                    enctype='multipart/form-data'
                    action="{{ route('admin.feedback.update', $feedback) }}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $feedback->name }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Current Avatar:</label>
                            <input type="hidden" value="{{ $feedback->image }}" name="imageExisting">
                           <img src="{{$feedback->image}}" width="100" class="img-thumbnail">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Image:</label>
                        
                            <input type="file" class="form-control" name="image" value="{{ $feedback->image }}">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" cols="30" rows="10">{{ $feedback->description }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1" name="status" value="1"
                                    {{ old('status', $feedback->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="check1">Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a type="cancel" class="btn btn-warning"
                            href="{{ route('admin.form.cancel', $feedback->id) }}">Cancel</a>
                    </form>
                @else
                <form method="POST" 
                enctype='multipart/form-data'
                action="{{ route('admin.feedback.create') }}">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ old("name") }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="image" class="form-label">Avatar:</label>
                        <input type="file" class="form-control" name="image" >
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="form-control" cols="30" rows="10">{{ old("description") }}</textarea>
                        @error('description')
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
