<?php

namespace App\Models;

use App\Models\BookmarkDetails;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $table = 'bookmarks';

    protected $fillable = [
        'name',
    ];

    public function details()
    {
        return $this->hasOne(BookmarkDetails::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
