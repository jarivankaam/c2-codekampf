<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function headerNav() {
        $pages = Page::all()->all();
        $categories = Category::all()->all();
        return view("includes/header")
            ->with("categories", $categories)->with("pages", $pages);
    }
    public static function index(){
        return view('home');
    }

}
