<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = DB::select('SELECT * FROM Orders');
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $requestedQuantity = $request->input('requested_quantity');
        $orderDate = $request->input('order_date');
        $expectedDeliveryDate = $request->input('expected_delivery_date');
        $orderStatus = $request->input('order_status');
        $idClient = $request->input('id_client');
        $idOffer = $request->input('id_offer');

        $id = DB::selectOne('SELECT insert_order(?, ?, ?, ?, ?, ?) AS id', [
            $requestedQuantity,
            $orderDate,
            $expectedDeliveryDate,
            $orderStatus,
            $idClient,
            $idOffer
        ])->id;

        return redirect('/orders');
    }

    public function edit($id)
    {
        $order = DB::selectOne('SELECT * FROM Orders WHERE id_order = ?', [$id]);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $requestedQuantity = $request->input('requested_quantity');
        $orderDate = $request->input('order_date');
        $expectedDeliveryDate = $request->input('expected_delivery_date');
        $orderStatus = $request->input('order_status');
        $idClient = $request->input('id_client');
        $idOffer = $request->input('id_offer');

        DB::selectOne('SELECT update_order(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $requestedQuantity,
            $orderDate,
            $expectedDeliveryDate,
            $orderStatus,
            $idClient,
            $idOffer
        ]);

        return redirect('/orders');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_order(?)', [$id]);

        return redirect('/orders');
    }
}