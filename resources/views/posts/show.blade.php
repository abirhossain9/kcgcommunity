<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        .footer a {
            color: #adb5bd;
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }
    </style>
</head>
<body>

<!-- Navbar -->
@include('layouts.no-auth-nav')

<!-- Post Details Section -->
<div class="container my-5">
    <h1>{{ $post->title }}</h1>
    <img src="{{ asset($post->image) }}" class="img-fluid" alt="Post Image">
    <p>{{ $post->content }}</p>

    <!-- Comments Section -->
    <div class="mt-4">
        <h3>Comments</h3>

        @foreach($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                    <small class="text-muted">Posted by {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</small>
                </div>
            </div>
        @endforeach

        <!-- Comment Form -->
        @auth
            <form action="{{ route('posts.storeComment', $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment">Leave a Comment</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        @else
            <p>You must <a href="{{ route('login') }}">login</a> to comment.</p>
        @endauth
    </div>
</div>
<!-- Footer -->
<footer class="footer text-center">
    <div class="container">
        <p class="mb-0">© 2024 Kcg.edu Community Blog. All Rights Reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>
