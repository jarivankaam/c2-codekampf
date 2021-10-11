<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function create(){
        $cats = Category::all();

        return view('page/create')
            ->with("categories", $cats);
    }
    function store(Request $request){
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'color' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'contents' => 'required'
        ]);
        $page = new Page();
        $page->category_id = $request->category;
        $page->name = $request->name;
        $page->color = $request->color;
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->content = $request->contents;
        $page->save();

        return redirect()->route('home');
    }
}
