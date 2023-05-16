<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Blog::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('blogs.index', [
            'blogs' => $blogs
        ]);
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description' => 'required',
            'blogFile' => 'required',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
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

    public function show(Blog $blog)
    {
        return view('blogs.show', ['blog'=>$blog]);
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', ['blog'=>$blog]);
    }

    public function update(Blog $blog, Request $request)
    {
        request()->validate([
            'title'=>'required',
            'description' => 'required',
        ]);

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
