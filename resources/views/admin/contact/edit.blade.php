@extends('layouts.admin')

@section('title', 'Carausel Page')

@section('content')
    <div class="container p-5">
        <a class="btn btn-primary" href="{{ route('admin.contact.index') }}">Back to contact</a>
        <h1>Update form contact</h1>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>Info!</strong> {{ session('info') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.contact.update',$contact) }}"
                 enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email"
                 value="{{old("email",$contact->email)}}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" name="phone"
                 value="{{old("phone",$contact->phone)}}">
                @error('phone')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="address1" class="form-label">Address1:</label>
                <input type="text" class="form-control" name="address1" value="{{old("address1",$contact->address1)}}">
                @error('address1')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="address2" class="form-label">Address2:</label>
                <input type="text" class="form-control" name="address2" value="{{old("address2",$contact->address2)}}">
                @error('address2')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="sologan1" class="form-label">Sologan1:</label>
                <input type="text" class="form-control" name="sologan1" value="{{old("sologan1",$contact->sologan1)}}">
                @error('sologan1')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="sologan2" class="form-label">Sologan2:</label>
                <input type="text" class="form-control" name="sologan2" value="{{old("sologan2",$contact->sologan2)}}">
                @error('sologan2')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="person" class="form-label">Kỹ sư:</label>
                <input type="text" class="form-control" name="person" value="{{old("person",$contact->person)}}">
                @error('person')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Curent Logo:</label>
                <input type="hidden" value="{{$contact->logo}}" name="imageExisting">
                <img src="{{$contact->logo}}" width="150" class="img-thumbnail">
            </div>
            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Image:</label>
                <input type="file" class="form-control" name="logo">
                @error('logo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
