<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\InvoiceStatus;
use App\Notifications\InvoiceApproved;
use App\Notifications\InvoiceRejected;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::find(Auth::id())->supplierInvoices;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyers()
    {
        $allbuyers = array();
        $buyers = DB::table('invoices')->where('supplier_id', Auth::id())->pluck('buyer_id');
        foreach ($buyers as $buyer) {
            $allbuyers[] = User::find($buyer);
        }
        return $allbuyers;
    }

    public function suppliers()
    {
        $allsuppliers = array();
        $suppliers = DB::table('invoices')->where('buyer_id', Auth::id())->pluck('supplier_id');
        foreach ($suppliers as $supplier) {
            $allsuppliers[] = User::find($supplier);
        }
        return $allsuppliers;
    }

    public function buyerInvoices() {
        return User::find(Auth::id())->buyerInvoices;
    }

    public function supplierInvoices() {
        return User::find(Auth::id())->supplierInvoices;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'supplier_id' => Auth::id(),
            'buyer_id' => $request->input('buyer_id'),
            'invoice_amount' => $request->input('invoice_amount'),
            'due_date' => $request->input('due_date')
        ]);
        return $invoice;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Invoice::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update([
            'invoice_status' => $request->input('invoice_status')
        ]);
        if ($request->input('invoice_status') == 2) {
            $invoice->notify(new InvoiceApproved($id));
        }
        if ($request->input('invoice_status') == 3) {
            $invoice->notify(new InvoiceRejected($id));
        }
        return $invoice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function supplierApproved() {
        return User::find(Auth::id())->supplierInvoices()->where('invoice_status', 2)->get();
    }

    public function buyerApproved() {
        return User::find(Auth::id())->buyerInvoices()->where('invoice_status', 2)->get();
    }

    public function approved($id) {
        return User::find(Auth::id())->supplierInvoices()->where('invoice_status', 2)->where('buyer_id', $id)->get();
    }
}
