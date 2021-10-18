<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    /**
     * @var mixed|string
     */
    public $currentPath;

    public function getFullPath(): string {
        $path = "";
        if (is_numeric($this["parent_id"])) {
            $path = Category::query()->where("id", "=", $this["parent_id"])->limit(1)->get()->first()->getFullPath();
        }
        $path = $path . "/" . $this["slug"];
        return $path;
    }
}
