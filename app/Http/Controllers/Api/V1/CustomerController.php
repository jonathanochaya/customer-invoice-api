<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Services\V1\CustomerFilter;

class CustomerController extends Controller
{
    public function index(CustomerFilter $filter)
    {
        $customers = Customer::where($filter->transform(request()));

        if(request()->query('includeInvoices'))
            $customers->with('invoices');

        return new CustomerCollection($customers->paginate());
    }

    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    public function show(Customer $customer)
    {
        if(request()->query('includeInvoices'))
            $customer->loadmissing('invoices');

        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
