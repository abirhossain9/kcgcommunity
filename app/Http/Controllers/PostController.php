<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Community;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PostController extends Controller
{
    // Display all posts
    public function index()
    {
        // Fetch all posts with their associated communities
        $posts = Post::with('community')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function allPosts(Request $request)
    {
        $communityId = $request->query('community_id');

        // If a community is provided, filter posts by community
        if ($communityId) {
            $posts = Post::where('community_id', $communityId)->paginate(10);
        } else {
            // Otherwise, show all posts with pagination
            $posts = Post::paginate(10);
        }

        // Get all communities for the filter
        $communities = Community::all();

        return view('posts.index', compact('posts', 'communities'));
    }

    // Show the form for creating a new post
    public function create()
    {
        // Fetch all communities for the selection
        $communities = Community::all();
        return view('admin.posts.create', compact('communities'));
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'community_id' => 'required|exists:communities,id', // Validation for community selection
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/posts/' . $imageName;

            // Initialize the ImageManager with the GD driver
            $manager = new ImageManager(new Driver());

            // Read the image from the file
            $image = $manager->read($image);

            // Resize the image (scale by width)
            $image->scale(800); // You can adjust the scale as needed, or use resize() for fixed dimensions

            // Save the resized image
            $image->save(public_path($imagePath));
        }

        // Create the post associated with the selected community
        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imagePath,
            'community_id' => $request->input('community_id'), // Store the selected community ID
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    // Show the form for editing a specific post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $communities = Community::all(); // Get all communities for selection
        return view('admin.posts.edit', compact('post', 'communities'));
    }

    // Update the specified post in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'community_id' => 'required|exists:communities,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $imagePath = $post->image;

        // Handle image upload and deletion
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/posts/' . $imageName;

            // Initialize the ImageManager with the GD driver
            $manager = new ImageManager(new Driver());

            // Read the image from the file
            $image = $manager->read($image);

            // Resize the image (scale by width)
            $image->scale(800); // You can adjust the scale as needed, or use resize() for fixed dimensions

            // Save the resized image
            $image->save(public_path($imagePath));
        }

        // Update the post details
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imagePath,
            'community_id' => $request->input('community_id'),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    // Remove the specified post from the database
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete the image file if it exists
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        // Delete the post
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'content' => $request->comment,
            'user_id' => auth()->id(), // assuming the user is logged in
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully.');
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->latest()->get(); // Fetch comments for the post
        return view('posts.show', compact('post', 'comments'));
    }

}
