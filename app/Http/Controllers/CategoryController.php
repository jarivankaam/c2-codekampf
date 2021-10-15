<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function create() {
        $categories = Category::all()->all();
        return view("category.create")
            ->with("categories", $categories);
    }

    function store(Request $request) {
        $request->validate([
            "title" => "required",
            "slug" => "required",
            "description" => "required",
        ]);

        $category = new Category();

        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent;
        $category->description = $request->description;
        $category->save();

        return redirect()->route("category", [$category->slug]);
    }


    function categoryList() {
        $categories = Category::all()->all();
        return view("admin.categories")
            ->with("categories", $categories);
    }

    function get($category_slug) {
        $category = PageController::getCategory($category_slug);

        if ($category == null) {
            abort(404);
            return null;
        }

        return view("category.category")
            ->with("category", $category)
            ->with("pages", $this->getPages($category));
    }


    function delete(Category $category) {
        $category->delete();
        return redirect()->route("category.list");
    }

    function getPages(Category $category): ?array
    {
        return Page::query()->where("category_id", "=", $category["id"])->get()->all();
    }

    function edit($slug){
        $categories = Category::all()->all();
        $category = PageController::getCategory($slug);
        return view("category.edit")
            ->with("category", $category)
            ->with("categories", $categories);
    }
    function update(Request $request, Category $category) {
        $request->validate([
            "title" => "required",
            "slug" => "required",
            "description" => "required",
        ]);

        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent;
        $category->description = $request->description;
        $category->save();

        return redirect()->route("category", [$category->slug]);
    }
}
