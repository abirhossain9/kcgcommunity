@extends('layouts.admin')

@section('title', 'Posts')

@section('main')
    <div class="container mt-4">
        <h2 class="mb-4">Posts</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Community</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->community->name }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ asset($post->image) }}" alt="Post Image" style="max-width: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
