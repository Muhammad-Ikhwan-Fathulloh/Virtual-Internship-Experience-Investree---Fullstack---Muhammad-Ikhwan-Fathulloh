<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\PostCategoryModel;

class LandingPageController extends Controller
{
    public function index()
    {
        $postcategories = PostCategoryModel::get();
        $posts = PostModel::get();

        return view('landingpage', compact('posts','postcategories'));
    }
}
