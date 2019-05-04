<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deletecriteria extends Model
{
    /**
     * The archived news from this delete criteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivednews()
    {
        return $this->hasMany(Archivednews::class);
    }
}
