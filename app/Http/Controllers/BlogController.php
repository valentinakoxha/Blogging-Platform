<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('blogs.index', ['blogs' => $blogs]);
    }
    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $blog = Blog::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id,
        ]);
        
        if ($request->hasFile('blogFile')) {
            $blog->addMultipleMediaFromRequest(['blogFile'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('blogs');
            });
            
        }
        return redirect('blog');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    public function update(Blog $blog, Request $request)
    {
        $blog->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id,
        ]);

        if ($request->hasFile('blogFile')) {
            $blog->clearMediaCollection('blogs');
            $blog->addMultipleMediaFromRequest(['blogFile'])
            ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('blogs');
            });

        }
        
        return redirect('blog');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

    	return redirect('blog');
    }
}
