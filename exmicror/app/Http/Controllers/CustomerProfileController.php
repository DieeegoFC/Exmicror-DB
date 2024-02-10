<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerProfileController extends Controller
{
    public function index()
    {
        $customerProfiles = DB::select('SELECT * FROM CustomerProfile');
        return view('customerProfiles.index', compact('customerProfiles'));
    }

    public function create()
    {
        return view('customerProfiles.create');
    }

    public function store(Request $request)
    {
        $customerName = $request->input('customer_name');
        $demographicInformation = $request->input('demographic_information');
        $customerContact = $request->input('customer_contact');
        $purchaseHistory = $request->input('purchase_history');
        $preferences = $request->input('preferences');
        $idDistributionClient = $request->input('id_distribution_client');

        $id = DB::selectOne('SELECT insert_customer_profile(?, ?, ?, ?, ?, ?) AS id', [
            $customerName,
            $demographicInformation,
            $customerContact,
            $purchaseHistory,
            $preferences,
            $idDistributionClient
        ])->id;

        return redirect('/customerProfiles');
    }

    public function edit($id)
    {
        $customerProfile = DB::selectOne('SELECT * FROM CustomerProfile WHERE id_customer = ?', [$id]);
        return view('customerProfiles.edit', compact('customerProfile'));
    }

    public function update(Request $request, $id)
    {
        $customerName = $request->input('customer_name');
        $demographicInformation = $request->input('demographic_information');
        $customerContact = $request->input('customer_contact');
        $purchaseHistory = $request->input('purchase_history');
        $preferences = $request->input('preferences');
        $idDistributionClient = $request->input('id_distribution_client');

        DB::selectOne('SELECT update_customer_profile(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $customerName,
            $demographicInformation,
            $customerContact,
            $purchaseHistory,
            $preferences,
            $idDistributionClient
        ]);

        return redirect('/customerProfiles');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_customer_profile(?)', [$id]);

        return redirect('/customerProfiles');
    }
}