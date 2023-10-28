<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
            'blogText' => 'required|string',
        ]);

        // save image into the system folder
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('blog', 'public');
        }
        // dd($request->file('image'));
        Blog::create([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'author' => $request->input('author'),
            'image' => $imagePath, // Store the image in the 'images' directory
            'blogText' => $request->input('blogText'),
        ]);

        // You can add a success message and redirect to a success page or return a response as needed.

        // Example:
        return redirect()->route('home')->with('success', 'Blog post created successfully');
    }

    public function edit(Blog $blog)
    {
        return view('admin.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'author' => 'required|string|max:255',
            'blogText' => 'required|string',
            'created_at' => 'required|string'
        ]);

        // save image into the system folder
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('blog', 'public');
        }

        $blog->update([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'author' => $request->input('author'),
            'image' => $imagePath ?? $blog->image,
            'blogText' => $request->input('blogText'),
            'created_at' => $request->input('created_at')
        ]);

        return redirect()->route('home')->with('success', 'Blog post created successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('home')->with('success', 'Blog deleted successfully');
    }
}
