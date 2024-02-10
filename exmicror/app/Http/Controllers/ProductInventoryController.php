<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductInventoryController extends Controller
{
    public function index()
    {
        $productInventory = DB::select('SELECT * FROM ProductInventory');
        return view('productInventory.index', compact('productInventory'));
    }

    public function create()
    {
        return view('productInventory.create');
    }

    public function store(Request $request)
    {
        $availableQuantity = $request->input('available_quantity');
        $manufactureDate = $request->input('manufacture_date');
        $expirationDate = $request->input('expiration_date');
        $idLabel = $request->input('id_label');
        $idPackaging = $request->input('id_packaging');
        $idCompliance = $request->input('id_compliance');
        $idOrder = $request->input('id_order');
        $idDistributionClient = $request->input('id_distribution_client');
        $idOffer = $request->input('id_offer');

        $id = DB::selectOne('SELECT insert_product_inventory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?) AS id', [
            $availableQuantity,
            $manufactureDate,
            $expirationDate,
            $idLabel,
            $idPackaging,
            $idCompliance,
            $idOrder,
            $idDistributionClient,
            $idOffer
        ])->id;

        return redirect('/productInventory');
    }

    public function edit($id)
    {
        $productInventory = DB::selectOne('SELECT * FROM ProductInventory WHERE id_inventory = ?', [$id]);
        return view('productInventory.edit', compact('productInventory'));
    }

    public function update(Request $request, $id)
    {
        $availableQuantity = $request->input('available_quantity');
        $manufactureDate = $request->input('manufacture_date');
        $expirationDate = $request->input('expiration_date');
        $idLabel = $request->input('id_label');
        $idPackaging = $request->input('id_packaging');
        $idCompliance = $request->input('id_compliance');
        $idOrder = $request->input('id_order');
        $idDistributionClient = $request->input('id_distribution_client');
        $idOffer = $request->input('id_offer');

        DB::selectOne('SELECT update_product_inventory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $availableQuantity,
            $manufactureDate,
            $expirationDate,
            $idLabel,
            $idPackaging,
            $idCompliance,
            $idOrder,
            $idDistributionClient,
            $idOffer
        ]);

        return redirect('/productInventory');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_product_inventory(?)', [$id]);
        return redirect('/productInventory');
    }
}