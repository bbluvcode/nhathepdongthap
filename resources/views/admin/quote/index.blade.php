@extends('layouts.admin')
@section('title', 'Carausel Page')
@section('content')
    <div class="container">
        @if (!empty($success))
        <div class="alert alert-success">
            <strong>Success!</strong>{{ $success }}
        </div>
        @endif
      
        <h1 class="text-center bg-primary">QUOTE LIST</h1>
        <a class="btn btn-primary mt-2" href="{{ route('admin.quote.create') }}">Create a new Quote</a>
        <table class="table knowtable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotes as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item-> author}}</td>
                        <td>
                        <a class="btn btn-warning" href="{{route("admin.quote.edit",$item->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" href="{{route("admin.quote.delete",$item->id)}}"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

