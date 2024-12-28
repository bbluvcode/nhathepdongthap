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
                @if ($panelJobImages->count() > 0)
                    <table class="table knowtable">
                        <h1>Danh Sach Panel Job Image</h1>

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>PanelJob</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($panelJobImages as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><img src="{{ $item->image }}" width="100" class="img-thumbnail" /></td>
                                    <td>{{ $item->panelJob->title }}</td>
                                    <td>
                                        {{ $item->status ? 'Active' : 'DisActive' }}
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('admin.panelJob.editPanelJobImage', $item->id) }}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-danger"
                                            href="{{ route('admin.panelJob.deletePanelJobImage', $item->id) }}"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="btn btn-info text-center">Chua co job image nao</p>
                @endif

            </div>
            <div class="col-md-5">
                <h1>Create form Panel Job</h1>
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>Info!</strong> {{ session('info') }}
                    </div>
                @endif
                @if ($panelJobImage)
                    <form method="POST" enctype='multipart/form-data'
                    action="{{ route('admin.panelJob.updatePanelImage', $panelJobImage) }}">
                        @csrf
                        <input type="hidden" value="{{ $panelJob->id }}" name="panel_id">
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Current Image:</label>
                            <input type="hidden" value="{{ $panelJob->image }}" name="imageExisting">
                           <img src="{{$panelJobImage->image}}" width="100" class="img-thumbnail">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Image:</label>
                        
                            <input type="file" class="form-control" name="image" value="{{ $panelJobImage->image }}">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1" name="status" value="1"
                                    {{ old('status', $panelJobImage->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="check1">Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a type="cancel" class="btn btn-warning"
                            href="{{ route('admin.form.cancel', $panelJobImage->id) }}">Cancel</a>
                    </form>
                @else
                    {{-- @dd($panelJob) --}}
                    <form method="POST" action="{{ route('admin.panelJob.storePanelImage', $panelJob->id) }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" value="{{ $panelJob->id }}" name="panel_id">
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
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
