@extends('layouts.admin')
@section('title', 'Carausel Page')
@section('content')
    <div class="container">
        @if (!empty($success))
        <div class="alert alert-success">
            <strong>Success!</strong>{{ $success }}
        </div>
        @endif
      
        <h1 class="text-center bg-primary">PROJECT LIST</h1>
        <a class="btn btn-primary mt-2" href="{{ route('admin.project.create') }}">Create a new Project</a>
        <table class="table knowtable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Owner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
        
                        <td>
                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="100">
                            @endif
                        </td>
                        <td>{{ $item-> owner}}</td>
                        <td>
                        <a class="btn btn-warning" href="{{route("admin.project.edit",$item->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" href="{{route("admin.project.delete",$item->id)}}"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

