<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarcodeLabelsController extends Controller
{
    public function index()
    {
        $barcodeLabels = DB::select('SELECT * FROM BarcodeLabels');
        return view('barcodeLabels.index', compact('barcodeLabels'));
    }

    public function create()
    {
        return view('barcodeLabels.create');
    }

    public function store(Request $request)
    {
        $labelInformation = $request->input('label_information');
        $barcode = $request->input('barcode');

        $id = DB::selectOne('SELECT insert_barcode_label(?, ?) AS id', [$labelInformation, $barcode])->id;

        return redirect('/barcodeLabels');
    }

    public function edit($id)
    {
        $barcodeLabel = DB::selectOne('SELECT * FROM BarcodeLabels WHERE id_label = ?', [$id]);
        return view('barcodeLabels.edit', compact('barcodeLabel'));
    }

    public function update(Request $request, $id)
    {
        $labelInformation = $request->input('label_information');
        $barcode = $request->input('barcode');

        DB::selectOne('SELECT update_barcode_label(?, ?, ?)', [$id, $labelInformation, $barcode]);

        return redirect('/barcodeLabels');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_barcode_label(?)', [$id]);

        return redirect('/barcodeLabels');
    }
}