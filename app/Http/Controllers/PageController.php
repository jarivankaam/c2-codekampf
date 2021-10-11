<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;
use Parsedown;

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

    function get(Request $request, string $category_slug, string $page_slug) {
        $cat = $this->getCategory($category_slug);

        if ($cat == null) {
            abort(404);
            return null;
        }

        $page = $this->getPage($cat["id"], $page_slug);

        if ($page == null) {
            abort(404);
            return null;
        }

        $parseDown = new Parsedown();
        $content = $parseDown->text($page["content"]);


        return ;
    }

    function getCategory(string $slug): ?Category {
        return Category::query()->where("slug", "=", $slug)->get()->first();
    }

    function getPage($catId, string $slug): ?Page {
        return Page::query()->where("category_id", "=", $catId)->where("slug", "=", $slug)->get()->first();
    }
}
