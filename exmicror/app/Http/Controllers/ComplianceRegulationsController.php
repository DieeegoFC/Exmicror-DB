<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplianceRegulationsController extends Controller
{
    public function index()
    {
        $complianceRegulations = DB::select('SELECT * FROM ComplianceRegulations');
        return view('complianceRegulations.index', compact('complianceRegulations'));
    }

    public function create()
    {
        return view('complianceRegulations.create');
    }

    public function store(Request $request)
    {
        $mexicoCompliance = $request->input('mexico_compliance');
        $unitedStatesCompliance = $request->input('united_states_compliance');

        $id = DB::selectOne('SELECT insert_compliance_regulation(?, ?) AS id', [$mexicoCompliance, $unitedStatesCompliance])->id;

        return redirect('/complianceRegulations');
    }

    public function edit($id)
    {
        $complianceRegulation = DB::selectOne('SELECT * FROM ComplianceRegulations WHERE id_compliance = ?', [$id]);
        return view('complianceRegulations.edit', compact('complianceRegulation'));
    }

    public function update(Request $request, $id)
    {
        $mexicoCompliance = $request->input('mexico_compliance');
        $unitedStatesCompliance = $request->input('united_states_compliance');

        DB::selectOne('SELECT update_compliance_regulation(?, ?, ?)', [$id, $mexicoCompliance, $unitedStatesCompliance]);

        return redirect('/complianceRegulations');
    }

    public function destroy($id)
    {
        DB::selectOne('SELECT delete_compliance_regulation(?)', [$id]);

        return redirect('/complianceRegulations');
    }
}