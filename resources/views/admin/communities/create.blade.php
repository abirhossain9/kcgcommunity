@extends('layouts.admin')

@section('title', 'Create New Community')


@section('main')
    <div class="container mt-5">
        <h2>Create Community</h2>
        <form action="{{ route('admin.communities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group mt-3">
                <label for="image">Upload Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>

@endsection
