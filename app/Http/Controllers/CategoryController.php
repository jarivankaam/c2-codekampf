<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function create() {
        return view("category.create");
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

    function getPages(Category $category): ?array
    {
        return Page::query()->where("category_id", "=", $category["id"])->get()->all();
    }
}
