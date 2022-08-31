<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\V1\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;

class InvoiceController extends Controller
{
    public function index(InvoiceFilter $filter)
    {
        $filterOptions = $filter->transform(request());

        return new InvoiceCollection(Invoice::where($filterOptions)->paginate()->withQueryString());
    }

    public function store(Request $request)
    {

    }

    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        $bulk_data = collect($request->all())->map(function($item) {
            return Arr::except($item, ['customerId', 'billedDate', 'paidDate']);
        });

        return Invoice::insert($bulk_data->toArray());
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
