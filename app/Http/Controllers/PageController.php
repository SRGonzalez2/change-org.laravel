<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petition;
use App\Models\Category;

class PageController extends Controller
{
    public function home()
    {
        $petitions = Petition::orderBy('created_at', 'desc')->take(4)->get();
        $categories = Category::all();
        return view('pages.home', compact('petitions', 'categories'));
    }
}
