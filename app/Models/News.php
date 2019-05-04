<?php

namespace App\Models;

use App\Traits\HasCategory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AccessedViaSlugAttribute;

class News extends Model
{
    use AccessedViaSlugAttribute, HasCategory;

    /**
     * @var array
     */
    protected $guarded = [];
}
