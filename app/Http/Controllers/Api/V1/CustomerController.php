<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Services\V1\CustomerFilter;

class CustomerController extends Controller
{
    public function index(CustomerFilter $filter)
    {
        $queryItems = $filter->transform(request());

        $includeInvoices = request()->query('includeInvoices');

        $customers = Customer::where($queryItems);

        if($includeInvoices)
            $customers->with('invoices');

        return new CustomerCollection($customers->paginate());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        if(request()->query('includeInvoices'))
            $customer->loadmissing('invoices');

        return new CustomerResource($customer);
    }

    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
