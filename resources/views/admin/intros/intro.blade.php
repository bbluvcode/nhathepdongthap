@extends('layouts.admin')
@section('title', 'Carausel Page')
@section('content')
    <div class="container">
        <h1 class="text-center bg-primary">INTRO HOME</h1>
        <div class="row">
            <div class="col-md-7">
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Info!</strong> {{ session('success') }}
                    </div>
                @endif
                @if ($intro)
                    {{-- @dd($intro) --}}
                    <form method="POST" action="{{ route('admin.updateIntro', $intro) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" value="{{ old('title', $intro->title) }}"
                                name="title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Description:</label>
                            <textarea class="form-control" rows="10" name="description">{{ old('description', $intro->description) }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Current Image:</label>
                            <input type="hidden" value="{{ $intro->image }}" name="imageExisting">
                            <img src="{{ $intro->image }}" width="100" class="thumbnail" />
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.storeHomeIntro') }}" enctype="multipart/form-data">
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
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                @endif
            </div>
            <div class="col-md-5">
                @if (session('successBenefit'))
                    <div class="alert alert-info">
                        <strong>Info!</strong> {{ session('successBenefit') }}
                    </div>
                @endif
                <form method="POST" id="benefitForm">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="benefit_title" name="title">
                    </div>
                    <button type="submit" class="btn btn-primary btn-benefit">Submit</button>
                </form>

                <h2>DANH SACH BENEFIT</h2>
                <table class="table knowtable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($benefits as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    {{ $item->title }}
                                </td>
                                <td>
                                    <button class="btn btn-warning" id="btnEditBenefit"
                                        onclick="handleGetEditBenefit({{ $item->id }})"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <a class="btn btn-danger" href="{{route("admin.delete.benefit",$item->id)}}"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    {{-- <script type="text/javascript">
        setTimeout(function() {
            // Closing the alert 
            $('.alert').alert('close');
            console.log("alo 123");
        }, 2000);
    </script> --}}
    <script>
        // AJAX POST request
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let title = document.querySelector("#benefit_title");
        let btnBenefit = document.querySelector(".btn-benefit");
        let isUpdateBenefit = false;
        let idItemBenefit;
        $(document).ready(function() {
            $('#benefitForm').on('submit', function(e) {
                e.preventDefault(); // Ngừng reload trang
                if (isUpdateBenefit) {
                    axios.put(`/admin/introBenefit/${idItemBenefit}`, {
                            title: title.value
                        }, {
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        }).then(response => {
                            console.log("update response: ",response);
                            isUpdateBenefit = false;
                            window.location.href = "/admin/intro";
                        })
                        .catch(err => {
                            console.log("err: ", err);

                        });
                } else {
                    axios.post('/admin/introBenefit', {
                            title: title.value
                        }, {
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        }).then(response => {
                            console.log(response);
                            window.location.href = "/admin/intro";
                        })
                        .catch(err => {
                            console.log("err: ", err);

                        });

                }

            });

            // $('#btnEditBenefit').on('click', function(e) {
            //     axios.post('/admin/introBenefit', {
            //         title: title
            //     }, {
            //         headers: {
            //             'X-CSRF-TOKEN': csrfToken
            //         }
            //     }).then(response => {
            //         console.log(response);
            //         window.location.href = "/admin/intro";
            //     })
            //     .catch(err => {
            //     console.log("err: ",err);

            //     });
            // });
        });

        function handleGetEditBenefit(id) {
            console.log("id: ", id);
            axios.get(`/admin/introBenefit/${id}`)
                .then(res => {
                    title.value = res.data.title;
                    btnBenefit.textContent = "Update";
                    isUpdateBenefit = true;
                    idItemBenefit = id;
                })
                .catch(err => console.log(err))
        }
    </script>
@endsection
