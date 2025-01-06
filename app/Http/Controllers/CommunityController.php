<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

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

            // Resize the image using native PHP
            $this->resizeImage($image, public_path($imagePath), 300);
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

            // Resize the image using native PHP
            $this->resizeImage($image, public_path($imagePath), 300);

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

    // Resize image function
    private function resizeImage($image, $destinationPath, $width)
    {
        // Get image info
        list($originalWidth, $originalHeight, $imageType) = getimagesize($image);

        // Calculate the new height to maintain aspect ratio
        $height = ($originalHeight / $originalWidth) * $width;

        // Create a new image resource based on the file type
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $src = imagecreatefromjpeg($image);
                break;
            case IMAGETYPE_PNG:
                $src = imagecreatefrompng($image);
                break;
            case IMAGETYPE_GIF:
                $src = imagecreatefromgif($image);
                break;
            default:
                return false;
        }

        // Create a blank true color image with the new dimensions
        $dst = imagecreatetruecolor($width, $height);

        // Resample the image to the new size
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);

        // Save the resized image
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($dst, $destinationPath);
                break;
            case IMAGETYPE_PNG:
                imagepng($dst, $destinationPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($dst, $destinationPath);
                break;
        }

        // Free up memory
        imagedestroy($src);
        imagedestroy($dst);

        return true;
    }
}
