<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kcg.edu Community Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            background: rgba(0, 0, 0, 0.5); /* Dark overlay with transparency */
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2; /* Makes sure the text stays on top of the overlay */
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

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

<!-- Hero Section -->
<div class="hero text-white" style="background: url('{{ asset('images/banner.jpg') }}') center/cover no-repeat; height: 500px;">
    <div class="container text-center">
        <h1>Welcome to Kcg.edu Community Blog</h1>
        <p class="lead">Connect with peers, share ideas, and explore amazing content from various communities.</p>
        <a href="#" class="btn btn-light btn-lg mt-3">Join a Community</a>
    </div>
</div>

<!-- Communities Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Explore Communities</h2>
        <div class="row">
            @foreach($communities as $community)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset($community->image) }}" class="card-img-top" alt="Community">
                        <div class="card-body">
                            <h5 class="card-title">{{ $community->name }}</h5>
                            <p class="card-text">{{ $community->description }}</p>
                            <a href="{{ url('/posts?community_id=' . $community->id) }}" class="btn btn-primary">View Posts</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Recent Posts Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Recent Posts</h2>
        <div class="row">
            @foreach($recentPosts as $post)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset($post->image) }}" class="card-img-top" alt="Post">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-secondary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

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
