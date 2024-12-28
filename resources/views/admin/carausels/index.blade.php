@extends('layouts.admin')
@section('title', 'Carausel Page')
@section('content')
    <div class="container">
        @if (!empty($success))
        <div class="alert alert-success">
            <strong>Success!</strong>{{ $success }}
        </div>
        @endif
      
        <h1 class="text-center bg-primary">CARAUSEL LIST</h1>
        <a class="btn btn-primary mt-2" href="{{ route('admin.carausels.create') }}">Create a new Carausel</a>
        <table class="table knowtable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carausels as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="100">
                            @endif
                        </td>
                        <td>
                            {{ $item->status }}
                        </td>
                        <td>
                        <a class="btn btn-warning" href="{{route("admin.carausels.edit",$item->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" href="{{route("admin.carausels.delete",$item->id)}}"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

