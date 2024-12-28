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
        <h1 class="text-center bg-primary">PANEL JOB</h1>
        <div class="row">
            <div class="col-md-7">
                <table class="table knowtable">
                    <h1>Danh Sach Panel Job</h1>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($panels as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td><span class="text-description">{{ $item->description }}</span></td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.panelJob.edit', $item->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="btn btn-danger" href="{{ route('admin.panelJob.delete', $item->id) }}"><i
                                            class="fa-solid fa-trash"></i></a>
                                    <a class="btn btn-info" href="{{ route('admin.panelJob.detail', $item->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <h1>Create form Panel Job</h1>
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>Info!</strong> {{ session('info') }}
                    </div>
                @endif
                @if ($panelJob)
                    <form method="POST" action="{{ route('admin.panelJob.storeUpdate', $panelJob) }}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" name="title" value="{{ $panelJob->title }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" cols="30" rows="10">{{ $panelJob->description }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="Type" class="form-label">Type:</label>
                            <select class="form-select" name="type">
                                <option value="1" {{ old('type', $panelJob->type) == 1 ? 'selected' : '' }}> NGHIEM
                                    THU BE
                                    TONG</option>
                                <option value="2" {{ old('type', $panelJob->type) == 2 ? 'selected' : '' }}>NGHIEM THU
                                    COT
                                    THEP</option>
                            </select>
                            @error('type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1" name="status" value="1"
                                    {{ old('status', $panelJob->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="check1">Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a type="cancel" class="btn btn-warning"
                            href="{{ route('admin.panelJob.cancel', $panelJob->id) }}">Cancel</a>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.panelJob.store') }}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" name="title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="Type" class="form-label">Type:</label>
                            <select class="form-select" name="type">
                                <option value="1"> NGHIEM THU BE TONG</option>
                                <option value="2">NGHIEM THU COT THEP</option>
                            </select>
                            @error('type')
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
                @endif

            </div>
        </div>
    </div>
@endsection
