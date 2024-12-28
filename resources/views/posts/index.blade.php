<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
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

        .hero {
            background: url('https://via.placeholder.com/1920x500') center/cover no-repeat;
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .dropdown {
            width: 250px;
        }

        .dropdown .form-select {
            border-radius: 30px;
            padding: 10px 20px;
            border: 1px solid #ced4da;
        }

        .dropdown button {
            border-radius: 30px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
@include('layouts.no-auth-nav')


<!-- Posts Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">All Posts</h2>

    <!-- Community Filter -->
    <div class="d-flex justify-content-center mb-4">
        <form method="GET" action="{{ route('posts.index') }}" class="form-inline">
            <div class="dropdown d-flex">
                <select name="community_id" class="form-select me-2">
                    <option value="">All Communities</option>
                    @foreach($communities as $community)
                        <option value="{{ $community->id }}" {{ request('community_id') == $community->id ? 'selected' : '' }}>
                            {{ $community->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary ms-2">Filter</button>
            </div>
        </form>
    </div>

    <!-- Posts List -->
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="Post">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
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
