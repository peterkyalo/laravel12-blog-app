<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //Get all the categories
        $categories = Category::all();
        //Get all the posts
        $posts = Post::when(request('category_id'), function ($query) {
            $query->where('category_id', request('category_id'));
        })->OrderBy('id', 'DESC')
            ->get();
        //Pass the categories to the home view
        return view('home', compact('categories', 'posts'));
    }
}
