@extends('layouts.admin')

@section('title', 'Communities')

@section('main')
<div class="container mt-5">
    <h2>Communities</h2>
    <a href="{{ route('admin.communities.create') }}" class="btn btn-primary mb-3">Create New Community</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($communities as $community)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $community->name }}</td>
                <td>{{ $community->description }}</td>
                <td>
                    @if ($community->image)
                        <img src="{{ asset($community->image) }}" alt="{{ $community->name }}" width="80">
                    @else
                        <em>No Image</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.communities.edit', $community->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.communities.destroy', $community->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
