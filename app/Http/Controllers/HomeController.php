<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function categoryInclude() {
        $categories = Category::all()->all();
        return view("includes/header")
            ->with("categories", $categories);
    }

    public static function headerNav() {
        $categories = Category::all()->all();
        return view("includes/header")
            ->with("categories", $categories);
    }
}
