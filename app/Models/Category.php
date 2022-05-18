<?php

namespace App\Models;

use App\Models\Bookmark;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
