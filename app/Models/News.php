<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AccessedViaSlugAttribute;

class News extends Model
{
    use AccessedViaSlugAttribute;

    /**
     * @var array
     */
    protected $guarded = [];

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
