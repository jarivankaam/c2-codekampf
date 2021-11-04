<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController2 extends Controller
{
    public static function categoryInclude() {
        $categories = Category::all()->sortBy("title", SORT_NATURAL | SORT_FLAG_CASE);
        return view("includes/header")
            ->with("categories", $categories);
    }
}
