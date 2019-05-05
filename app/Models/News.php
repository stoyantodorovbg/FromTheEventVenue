<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\SearchQueryBuilder;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AccessedViaSlugAttribute;

class News extends Model
{
    use HasCategory,
        SearchQueryBuilder,
        AccessedViaSlugAttribute;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Prepare data for Archivednews creation
     *
     * @param array $data
     */
    public function archive(array $data): void
    {
        $data = array_merge($data, $this->toArray());
        unset($data['slug']);

        Archivednews::create($data);
    }
}
