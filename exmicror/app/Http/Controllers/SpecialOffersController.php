<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialOffersController extends Controller
{
    public function index()
    {
        $specialOffers = DB::select('SELECT * FROM SpecialOffers');
        return view('specialOffers.index', compact('specialOffers'));
    }

    public function create()
    {
        return view('specialOffers.create');
    }

    public function store(Request $request)
    {
        $offerDescription = $request->input('offer_description');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $includedProducts = $request->input('included_products');

        $id = DB::selectOne('SELECT insert_special_offer(?, ?, ?, ?) AS id', [
            $offerDescription,
            $startDate,
            $endDate,
            $includedProducts
        ])->id;

        return redirect('/specialOffers');
    }

    public function edit($id)
    {
        $specialOffer = DB::selectOne('SELECT * FROM SpecialOffers WHERE id_offer = ?', [$id]);
        return view('specialOffers.edit', compact('specialOffer'));
    }

    public function update(Request $request, $id)
    {
        $offerDescription = $request->input('offer_description');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $includedProducts = $request->input('included_products');

        DB::selectOne('SELECT update_special_offer(?, ?, ?, ?, ?)', [
            $id,
            $offerDescription,
            $startDate,
            $endDate,
            $includedProducts
        ]);

        return redirect('/specialOffers');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_special_offer(?)', [$id]);

        return redirect('/specialOffers');
    }
}