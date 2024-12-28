@extends('layouts.admin')

@section('title', 'Edit Post')

@section('main')
    <div class="container mt-4">
        <h2>Edit Post</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="community_id">Community</label>
                <select name="community_id" id="community_id" class="form-control" required>
                    <option value="">Select Community</option>
                    @foreach($communities as $community)
                        <option value="{{ $community->id }}" {{ old('community_id', $post->community_id) == $community->id ? 'selected' : '' }}>
                            {{ $community->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Post Image</label>
                <input type="file" id="image" name="image" class="form-control">
                @if($post->image)
                    <p>Current Image:</p>
                    <img src="{{ asset($post->image) }}" alt="Post Image" style="max-width: 100px;">
                @endif
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">Update Post</button>
        </form>
    </div>
@endsection
