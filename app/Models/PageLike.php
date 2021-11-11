<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageLike extends Model
{
    protected $table = "page_likes";

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo{
        return $this->belongsTo("users", "user_id", "id");
    }

    public function page(): \Illuminate\Database\Eloquent\Relations\BelongsTo{
        return $this->belongsTo("page", "page_id", "id");
    }

}
