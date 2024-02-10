<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributionClientsController extends Controller
{
    public function index()
    {
        $distributionClients = DB::select('SELECT * FROM DistributionClients');
        return view('distributionClients.index', compact('distributionClients'));
    }

    public function create()
    {
        return view('distributionClients.create');
    }

    public function store(Request $request)
    {
        $clientName = $request->input('client_name');
        $clientType = $request->input('client_type');
        $clientContact = $request->input('client_contact');
        $clientPhone = $request->input('client_phone');
        $clientEmail = $request->input('client_email');
        $contractualDetails = $request->input('contractual_details');

        $id = DB::selectOne('SELECT insert_distribution_client(?, ?, ?, ?, ?, ?) AS id', [
            $clientName,
            $clientType,
            $clientContact,
            $clientPhone,
            $clientEmail,
            $contractualDetails
        ])->id;

        return redirect('/distributionClients');
    }

    public function edit($id)
    {
        $distributionClient = DB::selectOne('SELECT * FROM DistributionClients WHERE id_distribution_client = ?', [$id]);
        return view('distributionClients.edit', compact('distributionClient'));
    }

    public function update(Request $request, $id)
    {
        $clientName = $request->input('client_name');
        $clientType = $request->input('client_type');
        $clientContact = $request->input('client_contact');
        $clientPhone = $request->input('client_phone');
        $clientEmail = $request->input('client_email');
        $contractualDetails = $request->input('contractual_details');

        DB::selectOne('SELECT update_distribution_client(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $clientName,
            $clientType,
            $clientContact,
            $clientPhone,
            $clientEmail,
            $contractualDetails
        ]);

        return redirect('/distributionClients');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_distribution_client(?)', [$id]);

        return redirect('/distributionClients');
    }
}