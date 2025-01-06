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
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/communities/' . $imageName;

            // Validate the image type by MIME type
            $validMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (in_array($image->getMimeType(), $validMimes)) {
                // Move the file to the desired location
                $image->move(public_path('uploads/communities'), $imageName);
            } else {
                return back()->with('error', 'Invalid image type');
            }
        }

        // Create the community
        Community::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.communities.index')->with('success', 'Community created successfully.');
    }

    // Show the form for editing a specific community
    public function edit($id)
    {
        $community = Community::findOrFail($id);
        return view('admin.communities.edit', compact('community'));
    }

    // Update the specified community
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $community = Community::findOrFail($id);
        $imagePath = $community->image;

        // Handle image upload and deletion
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($community->image && file_exists(public_path($community->image))) {
                unlink(public_path($community->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/communities/' . $imageName;

            // Validate the image type by MIME type
            $validMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (in_array($image->getMimeType(), $validMimes)) {
                // Move the file to the desired location
                $image->move(public_path('uploads/communities'), $imageName);
            } else {
                return back()->with('error', 'Invalid image type');
            }
        }

        // Update the community details
        $community->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.communities.index')->with('success', 'Community updated successfully.');
    }

    // Remove the specified community
    public function destroy($id)
    {
        $community = Community::findOrFail($id);

        // Delete the image file if it exists
        if ($community->image && file_exists(public_path($community->image))) {
            unlink(public_path($community->image));
        }

        // Delete the community
        $community->delete();

        return redirect()->route('admin.communities.index')->with('success', 'Community deleted successfully.');
    }
}
