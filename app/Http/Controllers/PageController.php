<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\PageLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Parsedown;

class PageController extends Controller
{
    function create(){
        $cats = Category::all();

        return view('page/create')
            ->with("categories", $cats);
    }

    function edit($pageSlug) {
        $cats = Category::all();
        $page = PageController::getPageBySlug($pageSlug);

        if ($page == null) {
            abort(404);
            return null;
        }

        return view("page.edit")
            ->with("page", $page)
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
        $page->price = $request->price;
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->content = $request->contents;
        $page->save();

        return redirect()->route('home');
    }

    function update(Request $request, Page $page){
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'color' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'contents' => 'required'
        ]);

        $page->category_id = $request->category;
        $page->name = $request->name;
        $page->color = $request->color;
        $page->price = $request->price;
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->content = $request->contents;
        $page->save();

        return redirect()->route('home');
    }

    function pageList() {
        $page = Page::all()->all();
        return view("admin.pages")
            ->with("page", $page);
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

    function delete(Page $page) {
        $page->delete();
        return redirect()->route("page.list");
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

    public static function getPageBySlug(string $slug): ?Page {
        return Page::query()->where("slug", "=", $slug)->get()->first();
    }

    public static function getPageById(int $id): ?Page {
        return Page::query()->where("id", "=", $id)->get()->first();
    }

    function like(Page $page) {
        $existingPageLike = PageLike::all()->where('page_id', '=', $page->id);

        if(Auth::id() != null){
            $existingPageLike = $existingPageLike->where('user_id', '=', Auth::id())->first();
        }else if(isset($_COOKIE['chat_session_uuid'])) {
            $existingPageLike = $existingPageLike->where('session_id', '=', $_COOKIE['chat_session_uuid'])->first();
        }

        if($existingPageLike == null){
            $pageLike = new PageLike();
            $pageLike->page_id = $page->id;
        }else{
            $pageLike = $existingPageLike;
        }

        if(Auth::id() != null){
            $pageLike->user_id = Auth::id();
            $pageLike->save();
        }else if(isset($_COOKIE['chat_session_uuid'])) {
            $pageLike->session_id = $_COOKIE['chat_session_uuid'];
            $pageLike->save();
        }

        return redirect()->back();
    }

    function dislike(Page $page) {
        $pageLike = PageLike::all()->where('page_id', '=', $page->id);

        if($pageLike == null){
            return redirect()->back();
        }

        if(Auth::id() != null){
            $pageLike = $pageLike->where('user_id', '=', Auth::id())->first();
            $pageLike->delete();
        }else if(isset($_COOKIE['chat_session_uuid'])) {
            $pageLike = $pageLike->where('session_id', '=', $_COOKIE['chat_session_uuid'])->first();
            $pageLike->delete();
        }

        return redirect()->back();
    }

}
