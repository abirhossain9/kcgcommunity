<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
// Get the 3 most recent posts
        $recentPosts = Post::query()->latest()->take(3)->get();

        // Get all communities
        $communities = Community::all();

        // Pass data to the view
        return view('home.index', compact('recentPosts', 'communities'));
    }

    public function about(){
        return view('home.about-us');
    }
}
