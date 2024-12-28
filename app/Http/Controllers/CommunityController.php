<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CommunityController extends Controller
{
    // Display all communities
    public function index()
    {
        $communities = Community::all();
        return view('admin.communities.index', compact('communities'));
    }

    // Show the form for creating a new community
    public function create()
    {
        return view('admin.communities.create');
    }

    // Store a new community
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/communities/' . $imageName;

            // Initialize the ImageManager with the GD driver
            $manager = new ImageManager(new Driver());

            // Read the image from the file
            $image = $manager->read($image);

            // Resize the image (scale by width)
            $image->scale(300); // You can also set the height, or use 'resize()' instead for fixed dimensions

            // Save the resized image
            $image->save(public_path($imagePath));
        }

        // Create a new community with the image path
        Community::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath, // Save the image path
        ]);

        return redirect()->route('admin.communities.index')->with('success', 'Community created successfully.');
    }

    // Show the form for editing a specific community
    public function edit($id)
    {
        $community = Community::findOrFail($id);
        return view('admin.communities.edit', compact('community'));
    }

    // Update the specified community in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $community = Community::findOrFail($id);

        // Handle image upload and deletion
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($community->image && file_exists(public_path($community->image))) {
                unlink(public_path($community->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/communities/' . $imageName;

            // Initialize the ImageManager with the GD driver
            $manager = new ImageManager(new Driver());

            // Read the image from the file
            $image = $manager->read($image);

            // Resize the image (scale by width)
            $image->scale(300); // You can adjust this to your preferred width

            // Save the resized image
            $image->save(public_path($imagePath));

            // Update the image path in the community model
            $community->image = $imagePath;
        }

        // Update other fields
        $community->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $community->image, // Updated image if any
        ]);

        return redirect()->route('admin.communities.index')->with('success', 'Community updated successfully.');
    }

    // Remove the specified community from the database
    public function destroy($id)
    {
        $community = Community::findOrFail($id);

        // Delete the image file if it exists
        if ($community->image && file_exists(public_path($community->image))) {
            unlink(public_path($community->image)); // Delete the image file
        }

        // Delete the community record
        $community->delete();

        return redirect()->route('admin.communities.index')->with('success', 'Community deleted successfully.');
    }
}
