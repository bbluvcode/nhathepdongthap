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
    <div class="container p-3">
        <h1 class="text-center bg-primary">CHI PHÍ GIÁM SÁT</h1>
        <div class="row">
            <a class="btn btn-info" href="{{ route('admin.price.create') }}">Tạo gói chi phí giám sát</a>
            <table class="table knowtable">
                <h3>DANH SÁCH CHI PHÍ GIÁM SÁT</h3>

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Package</th>
                        <th>Time week</th>
                        <th>Time day</th>
                        <th>Cost</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->package }}</td>
                            <td>{{ $item->timew }}</td>
                            <td>{{ $item->timed }}</td>
                            <td>{{ $item->cost }}</td>
                            <td>{{ $item->note }}</td>
                            <td>
                                {{ $item->status }}
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.price.edit', $item->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{ route('admin.price.delete', $item->id) }}"><i
                                        class="fa-solid fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <h3>Note Price</h3>
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>Info!</strong> {{ session('info') }}
                    </div>
                @endif
                @if ($notePrice)
                    <form method="POST" 
                    action="{{ route('admin.price.updateDesnote', $notePrice) }}">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="desNote" id="description" class="form-control" cols="30" rows="5">{{ old('desNote',$notePrice->desNote) }}</textarea>
                        @error('desNote')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                @else
                    <form method="POST" action="{{ route('admin.price.storeDesnote') }}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="desNote" id="description" class="form-control" cols="30" rows="5">{{ old('desNote') }}</textarea>
                            @error('desNote')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                @endif

            </div>
        </div>

    </div>
    <script>
        $('#description').summernote({
            tabsize: 2,
            height: 150
        });
        let markupStr = $('#summernote').summernote('code');
    </script>
@endsection
