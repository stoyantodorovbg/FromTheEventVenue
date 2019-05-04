<?php

namespace App\Models;

use App\Traits\HasCategory;
use Illuminate\Database\Eloquent\Model;

class Archivednews extends Model
{
    use HasCategory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * The delete criteria for this news
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deletecriteria()
    {
        return $this->belongsTo(Deletecriteria::class);
    }
}
