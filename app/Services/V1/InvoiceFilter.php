<?php

namespace App\Services\V1;

use App\Services\ApiFilter;

class InvoiceFilter extends ApiFilter
{
    // allowed filter parameters
    protected $allowedParams = [
        'customer_id' => ['eq'],
        'amount' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'billed_date' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'paid_date' => ['eq', 'lt', 'gt', 'lte', 'gte']
    ];

    // parameter to column map
    protected $columnMap = [
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date'
    ];
}
