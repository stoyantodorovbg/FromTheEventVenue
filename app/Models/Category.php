<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AccessedViaSlugAttribute;

class Category extends Model
{
    use AccessedViaSlugAttribute;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * The news from this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }
}
