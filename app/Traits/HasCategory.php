<?php


namespace App\Traits;


use App\Models\Category;

trait HasCategory
{
    /**
     * The category for this news
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
