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

<!-- Feedback Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2>We Value Your Feedback</h2>
            <p class="lead">Your feedback helps us improve and serve you better. Please let us know your thoughts!</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="mailto:abirhasan282@gmail.com" method="get" enctype="text/plain">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Feedback</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your feedback here..." required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </div>
                </form>
            </div>
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
