<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Resources\Invoice\InvoicedEventsResource;
use App\Http\Resources\Invoice\InvoicedUsersResource;
use App\Models\Customer;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Create a new invoice.
     *
     * @param CreateInvoiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateInvoiceRequest $request)
    {
        $customer = Customer::find($request->customer_id);

        $invoice = $customer->createInvoice($request->start, $request->end);

        if ($invoice) {
            $response = [
                'invoice' => $invoice
            ];
        } else {
            $response = [
                'message' => 'There is no new data to be invoiced.'
            ];
        }

        return response()->json($response);
    }

    /**
     * Show a specific invoice.
     *
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Invoice $invoice)
    {
        return response()->json([
            'total_price' => $invoice->total_price,
            'invoiced_users' => InvoicedUsersResource::collection($invoice->users),
            'invoiced_events' => InvoicedEventsResource::collection($invoice->events),
        ]);
    }
}
