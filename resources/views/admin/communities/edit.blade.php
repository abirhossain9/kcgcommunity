@extends('layouts.admin')

@section('title', 'Edit Community')

@section('main')
    <div class="container mt-5">
        <h2>Edit Community</h2>
        <form action="{{ route('admin.communities.update', $community->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $community->name }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $community->description }}</textarea>
            </div>
            <div class="form-group mt-3">
                <label for="image">Upload Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($community->image)
                    <img src="{{ asset($community->image) }}" alt="{{ $community->name }}" width="100" class="mt-3">
                @endif
            </div>
            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>

@endsection

