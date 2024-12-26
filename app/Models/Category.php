<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function categoryPost()
    {
        return $this->HasMany(CategoryPost::class);
    }
}
