<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('home.index')}}">Kcg.edu Community</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('home.index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('posts.index')}}">Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('feedback')}}">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('home.about')}}">About us</a></li>
                <li class="nav-item"><a class="btn btn-primary nav-link text-white px-3" href="{{ route('admin.dashboard.index') }}">{{\Illuminate\Support\Facades\Auth::id() ? 'Dashboard' : 'Login'}} </a></li>
            </ul>
        </div>
    </div>
</nav>
