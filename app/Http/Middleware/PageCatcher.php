<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Models\PageLike;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;
use Illuminate\Support\Facades\Auth;
use Parsedown;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class PageCatcher extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        $path = $request->decodedPath();

        $path = trim($path, "/");


        $arguments = explode("/", $path);

        if (count($arguments) == 1) {

            $category_slug = $arguments[0];

            $category = PageController::getCategory($category_slug);

            if ($category == null) {
                return $next($request);
            }

            if (is_numeric($category["parent_id"]))
                return $next($request);

            return Response::create(
            view("category.category")
                ->with("category", $category)
                ->with("pages", CategoryController::getPages($category)));
        } else {
            $page_slug = $arguments[count($arguments) - 1];

            array_pop($arguments);

            $categories = [];


            $lastCategoryId = null;
            foreach ($arguments as $category_slug) {
                $cat = PageController::getCategoryWithParent($category_slug, $lastCategoryId);

                if ($cat == null) {
                    return $next($request);
                }

                $lastCategoryId = $cat["id"];

                $path = "/";

                foreach ($categories as $cat2) {
                    $path = $path . $cat2["slug"] . "/";
                }
                $path = $path . $cat["slug"];

                $cat->currentPath = $path;

                array_push($categories, $cat);
            }

            $page = PageController::getPage($lastCategoryId, $page_slug);

            if ($page == null) {
                $category = PageController::getCategory($page_slug);

                if ($category == null) {
                    return $next($request);
                }
                return Response::create(
                view("category.category")
                    ->with("categories", $categories)
                    ->with("category", $category)
                    ->with("pages", CategoryController::getPages($category)));

            }

            $parseDown = new Parsedown();
            $content = $parseDown->text($page["content"]);

            $like = PageLike::all()
                ->where('page_id', '=', $page->id);

            if(Auth::id() != null){
                $like = $like->where('user_id', '=', Auth::id());
                $like = $like->first();
            }else if(isset($_COOKIE['chat_session_uuid'])) {
                $like = $like->where('session_id', '=', $_COOKIE['chat_session_uuid']);
                $like = $like->first();
            }

            return Response::create(view("page.page")
                ->with("content", $content)
                ->with("page", $page)
                ->with("categories", $categories)
                ->with('page_like', $like));
        }
    }
}
