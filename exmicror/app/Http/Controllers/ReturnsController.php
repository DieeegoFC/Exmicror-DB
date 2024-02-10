<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnsController extends Controller
{
    public function index()
    {
        $returns = DB::select('SELECT * FROM Returns');
        return view('returns.index', compact('returns'));
    }

    public function create()
    {
        return view('returns.create');
    }

    public function store(Request $request)
    {
        $returnedQuantity = $request->input('returned_quantity');
        $returnReason = $request->input('return_reason');
        $correctiveActions = $request->input('corrective_actions');
        $orderId = $request->input('id_order');

        $id = DB::selectOne('SELECT insert_return(?, ?, ?, ?) AS id', [
            $returnedQuantity,
            $returnReason,
            $correctiveActions,
            $orderId
        ])->id;

        return redirect('/returns');
    }

    public function edit($id)
    {
        $return = DB::selectOne('SELECT * FROM Returns WHERE id_return = ?', [$id]);
        return view('returns.edit', compact('return'));
    }

    public function update(Request $request, $id)
    {
        $returnedQuantity = $request->input('returned_quantity');
        $returnReason = $request->input('return_reason');
        $correctiveActions = $request->input('corrective_actions');
        $orderId = $request->input('id_order');

        DB::selectOne('SELECT update_return(?, ?, ?, ?, ?)', [
            $id,
            $returnedQuantity,
            $returnReason,
            $correctiveActions,
            $orderId
        ]);

        return redirect('/returns');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_return(?)', [$id]);

        return redirect('/returns');
    }
}