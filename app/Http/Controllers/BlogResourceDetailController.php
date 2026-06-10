<?php

namespace App\Http\Controllers;

use App\Models\BlogResourceDetail;
use Illuminate\Http\Request;

class BlogResourceDetailController extends Controller
{
    public function index()
    {
        $blogDetails = BlogResourceDetail::where('status', '1')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('blog-resource-details.index', compact('blogDetails'));
    }

    public function show($id)
    {
        $blogDetail = BlogResourceDetail::findOrFail($id);
        return view('blog-resource-details.show', compact('blogDetail'));
    }
}
