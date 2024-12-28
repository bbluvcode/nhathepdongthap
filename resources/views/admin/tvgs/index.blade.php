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
    {{-- @dd($newsTVSG) --}}
    <div class="container p-5">
        <h1 class="text-center bg-primary">TƯ VẤN GIÁM SÁT</h1>
        <div class="row">
            @if ($introTVSG)
                <form method="POST" action="{{ route('admin.tvgs.update', $introTVSG) }}">
                    <button type="button" class="btn btn-warning btnChangeStatus">Update Intro</button>
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" readonly placeholder="enter intro tvgs" class="form-control textDescription" cols="30"
                            rows="5">{{ $introTVSG->description }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btnUpdateIntro" disabled>Update</button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.tvgs.create') }}">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="form-control" placeholder="enter intro tvgs" cols="30" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            @endif
        </div>

        <div class="row">
            <h4 class="text-center">NEWS LIST</h4>
            <a class="btn btn-primary mt-2 w-25" href="{{ route('admin.post.create') }}">Tạo thêm tin tức</a>
            <table class="table knowtable">
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
                    @foreach ($newsTVSG as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="100">
                                @endif
                            </td>
                            <td>
                                {{ $item->status }}
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.post.edit', $item->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{ route('admin.post.delete', $item->id) }}"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <h4 class="text-center">ADS IMAGE LIST</h4>
            <a class="btn btn-primary mt-2 w-25" href="{{ route('admin.ads.create') }}">Tạo thêm ads</a>
            <table class="table knowtable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adsTVSG as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="100">
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.ads.edit', $item->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{ route('admin.ads.delete', $item->id) }}"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mt-2">
            <h4 class="text-center">SPECIAL ADS </h4>
            @if (session('infoSpecial'))
                <div class="alert alert-success">
                    <strong>Info!</strong> {{ session('infoSpecial') }}
                </div>
            @endif
            @if ($specialAds)
                <form method="POST" action="{{ route('admin.specads.update', $specialAds) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" value="{{ old('title', $specialAds->title) }}"
                            placeholder="nhập title" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="sort" class="form-label">Sort:</label>
                        <input type="text" name="sortDes" value="{{ old('sortDes', $specialAds->sortDes) }}"
                            placeholder="enter sort des" class="form-control">
                        @error('sortDes')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="image" class="form-label">CurrentImage:</label>
                        <input type="hidden" value="{{ $specialAds->image }}" class="form-control" name="imageExisting">
                        <img class="img-thumbnail" src="{{ $specialAds->image }}" width="150" />
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.specads.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" placeholder="nhập title" value="{{ old('title') }}"
                            class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="sort" class="form-label">Sort:</label>
                        <input type="text" name="sortDes" value="{{ old('sortDes') }}" placeholder="enter sort des"
                            class="form-control">
                        @error('sortDes')
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            @endif
        </div>
    </div>
    <script>
        let btnStatusUpdate = document.querySelector(".btnChangeStatus");
        let btnUpdateIntro = document.querySelector(".btnUpdateIntro");
        let btnIntroCancel = document.querySelector(".btnIntroCancel");
        let textDescription = document.querySelector('.textDescription')
        btnStatusUpdate.addEventListener('click', () => {
            textDescription.removeAttribute("readonly");
            btnUpdateIntro.removeAttribute("disabled");
            // Tạo một phần tử mới
            var newElement = document.createElement("button");
            newElement.textContent = "Cancel";
            newElement.setAttribute("class", "btn btn-info btnIntroCancel");
            // Thêm phần tử mới liền kề sau phần tử mục tiêu
            btnStatusUpdate.insertAdjacentElement("afterend", newElement);
        })
        if (btnIntroCancel) {
            btnIntroCancel.addEventListener('click', () => {
                textDescription.setAttribute("readonly", true);
                btnUpdateIntro.setAttribute("disabled", true);
            })
        }
    </script>
@endsection
