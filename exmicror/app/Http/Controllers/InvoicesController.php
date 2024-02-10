<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = DB::select('SELECT * FROM Invoices');
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $totalAmount = $request->input('total_amount');
        $issuanceDate = $request->input('issuance_date');
        $invoiceType = $request->input('invoice_type');
        $idOrder = $request->input('id_order');
        $idDistributionClient = $request->input('id_distribution_client');
        $idOffer = $request->input('id_offer');

        $id = DB::selectOne('SELECT insert_invoice(?, ?, ?, ?, ?, ?) AS id', [
            $totalAmount,
            $issuanceDate,
            $invoiceType,
            $idOrder,
            $idDistributionClient,
            $idOffer
        ])->id;

        return redirect('/invoices');
    }

    public function edit($id)
    {
        $invoice = DB::selectOne('SELECT * FROM Invoices WHERE id_invoice = ?', [$id]);
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $totalAmount = $request->input('total_amount');
        $issuanceDate = $request->input('issuance_date');
        $invoiceType = $request->input('invoice_type');
        $idOrder = $request->input('id_order');
        $idDistributionClient = $request->input('id_distribution_client');
        $idOffer = $request->input('id_offer');

        DB::selectOne('SELECT update_invoice(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $totalAmount,
            $issuanceDate,
            $invoiceType,
            $idOrder,
            $idDistributionClient,
            $idOffer
        ]);

        return redirect('/invoices');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_invoice(?)', [$id]);

        return redirect('/invoices');
    }
}