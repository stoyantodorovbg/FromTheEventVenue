<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchQueryBuilder
{
    /**
     * @var array
     */
    protected static $params_operators = [
        'created_at' => '=',
        'created_at_after' => '>=',
        'created_at_before' => '<=',
        'category_id' => '=',
        'deletecriteria_id' => '=',
    ];

    /**
     * @var array
     */
    protected static $request_model_conversions = [
        'created_at' => 'created_at',
        'created_at_after' => 'created_at',
        'created_at_before' => 'created_at',
        'category_id' => 'category_id',
        'deletecriteria_id' => 'deletecriteria_id',
    ];

    /**
     * Add queries to the builder
     *
     * @param array $params
     * @return Builder
     */
    public static function addQueries(array $params): Builder
    {
        $params = self::processData($params);

        $search_conditions = [];

        foreach ($params as $param) {
            $search_conditions[] = self::searchBy($param['model_field'], $param['request_value'], self::$params_operators[$param['request_key']]);
        }

        return self::where($search_conditions);
    }

    /**
     * Filter data
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @return array
     */
    protected static function searchBy(string $key, string $value, string $operator): array
    {
        if($key) {
            return [$key, $operator, $value];
        }

        return [];
    }

    /**
     * Process the data for DB fetching
     *
     * @param array $params
     * @return array
     */
    protected static function processData(array $params): array
    {
        $model_params = [];

        foreach ($params as $key => $value) {
            $model_params[] = [
                'request_key' => $key,
                'request_value' => $value,
                'model_field' => self::$request_model_conversions[$key],
            ];
        }

        return $model_params;
    }
}
