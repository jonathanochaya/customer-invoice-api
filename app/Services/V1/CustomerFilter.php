<?php

namespace App\Services\V1;

use App\Services\ApiFilter;

class CustomerFilter extends ApiFilter
{
    // allowed filter parameters
    protected $allowedParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'lt', 'gt'],
    ];

    // parameter to column map
    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];
}
