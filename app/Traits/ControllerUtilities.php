<?php


namespace App\Traits;

use Illuminate\Support\Str;

trait ControllerUtilities
{
    /**
     * Add slug to a model
     *
     * @param array $data
     * @param string $property_name
     * @return array
     */
    public function generateSlug(array $data, string $property_name): array
    {
        $data['slug'] = Str::slug($data[$property_name], '-');

        return $data;
    }
}
