<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

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
