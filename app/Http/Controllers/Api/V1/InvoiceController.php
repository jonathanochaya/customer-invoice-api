<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use App\Services\V1\InvoiceFilter;

class InvoiceController extends Controller
{
    public function index(InvoiceFilter $filter)
    {
        $filterOptions = $filter->transform(request());

        return new InvoiceCollection(Invoice::where($filterOptions)->paginate()->withQueryString());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
