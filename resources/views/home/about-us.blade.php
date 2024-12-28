<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Kcg.edu Community Blog</title>
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
        <h1>About Us</h1>
        <p class="lead">Learn more about Kcg.edu Community Blog and our mission.</p>
    </div>
</div>

<!-- About Us Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Our Mission</h2>
        <p class="lead text-center">At Kcg.edu Community Blog, our mission is to provide a platform for students, educators, and professionals to connect, share ideas, and collaborate on various topics. We aim to build a vibrant online community where knowledge and experiences can be exchanged freely.</p>

        <h3 class="mt-5">Our Values</h3>
        <ul>
            <li>Collaboration: We believe in the power of collective intelligence.</li>
            <li>Innovation: We strive to create new ideas and solutions for the community.</li>
            <li>Inclusivity: We are committed to providing a space for everyone, regardless of background or expertise.</li>
            <li>Respect: We value respectful conversations and the sharing of diverse perspectives.</li>
        </ul>
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
