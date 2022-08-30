<?php

namespace App\Services;

use Illuminate\Http\Request;

class ApiFilter
{
    // allowed operators
    protected $operatorMap = [
        'eq' => '=', // equal
        'lt' => '<',  // less than
        'lte' => '<=', // less than or equal
        'gt' => '>', // 'greater than
        'gte' => '>=', // greater than or equal
        'ne' => '!=' // not equal
    ];

    // allowed filter parameters
    protected $allowedParams = [];

    // parameter to column map
    protected $columnMap = [];

    // function request request in format: /?postalCode[gt] = 100
    // and should return eloquent ready format like this: [postal_code, >, 1000]
    public function transform(Request $request)
    {
        $responseQuery = [];

        foreach($this->allowedParams as $param => $operators) {
            $query = $request->query($param);

            if(!$query) continue;

            $db_column = $this->columnMap[$param] ?? $param;

            foreach($operators as $operator) {
                if(array_key_exists($operator, $this->operatorMap)
                    && array_key_exists($operator, $query)) {

                    // return eloquent ready format i.e postal_code > 1000
                    $responseQuery[] = [
                        $db_column, $this->operatorMap[$operator], $query[$operator]
                    ];
                }
            }
        }

        return $responseQuery;
    }
}
