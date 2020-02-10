<?php

namespace App\Models\Tags;

use App\Models\Books\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var bool
     */
    public $timestamps = false;


    /**
     * @return BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}