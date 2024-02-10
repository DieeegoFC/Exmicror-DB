<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackagingDetailsController extends Controller
{
    public function index()
    {
        $packagingDetails = DB::select('SELECT * FROM PackagingDetails');
        return view('packaging.index', compact('packagingDetails'));
    }

    public function create()
    {
        return view('packaging.create');
    }

    public function store(Request $request)
    {
        $packagingType = $request->input('packaging_type');
        $packagingMaterial = $request->input('packaging_material');

        $id = DB::selectOne('SELECT insert_packaging_details(?, ?) AS id', [$packagingType, $packagingMaterial])->id;

        return redirect('/packaging');
    }

    public function edit($id)
    {
        $packagingDetail = DB::selectOne('SELECT * FROM PackagingDetails WHERE id_packaging = ?', [$id]);
        return view('packaging.edit', compact('packagingDetail'));
    }

    public function update(Request $request, $id)
    {
        $packagingType = $request->input('packaging_type');
        $packagingMaterial = $request->input('packaging_material');

        DB::selectOne('SELECT update_packaging_details(?, ?, ?)', [$id, $packagingType, $packagingMaterial]);

        return redirect('/packaging');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_packaging_details(?)', [$id]);

        return redirect('/packaging');
    }
}