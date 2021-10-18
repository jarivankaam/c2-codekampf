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


    /**
     * Get a page and category
     * @param Request $request
     * @param string $category_slug
     * @param string $page_slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|null
     */
    function get(Request $request, string $categories) {
        $arguments = explode("/", $categories);

        if (count($arguments) == 1) {

            $category_slug = $arguments[0];

            $category = PageController::getCategory($category_slug);

            if ($category == null) {
                abort(404);
                return null;
            }

            return view("category.category")
                ->with("category", $category)
                ->with("pages", $this->getPages($category));
        } else {
            $page_slug = $arguments[count($arguments) - 1];

            array_pop($arguments);

            $categories = [];

            $lastCategoryId = null;
            foreach ($arguments as $category_slug) {
                $cat = self::getCategoryWithParent($category_slug, $lastCategoryId);

                if ($cat == null) {
                    abort(405);
                    return null;
                }

                $lastCategoryId = $cat["id"];

                array_push($categories, $cat);
            }

            $page = self::getPage($lastCategoryId, $page_slug);

            if ($page == null) {
                abort(405);
                return null;
            }

            $parseDown = new Parsedown();
            $content = $parseDown->text($page["content"]);


            return view("page.page")
                ->with("content", $content)
                ->with("page", $page)
                ->with("categories", $categories);


        }

//        $cat = $this->getCategory($category_slug);
//
//        if ($cat == null) {
//            abort(404);
//            return null;
//        }
//
//        $page = $this->getPage($cat["id"], $page_slug);
//

    }

    public static function getCategory(string $slug): ?Category {
        return Category::query()->where("slug", "=", $slug)->get()->first();
    }

    public static function getCategoryWithParent(string $slug, $catId): ?Category {
        return Category::query()->where("slug", "=", $slug)->where("parent_id", "=", $catId)->get()->first();
    }

    public static function getPage($catId, string $slug): ?Page {
        return Page::query()->where("category_id", "=", $catId)->where("slug", "=", $slug)->get()->first();
    }
}
