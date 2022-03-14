<?php

namespace App\Http\Controllers\Jetstream\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Village;
use App\Http\Requests\Patient\PatientRequest;
use Inertia\Inertia;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = (int) $request->get('per_page') > 0 ? (int) $request->get('per_page') : 15;
        $page = (int) $request->get('page') > 0 ? (int) $request->get('page') : 1;
        $queries = ['search', 'page'];
        return Inertia::render('Patient/Index', [
            'datas' => Patient::applyFilters($request->only($queries))
                ->paginateData($limit),
            'filtersDatas' => $request->all($queries),
            'start' => $limit * ($page - 1),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$villages = Village::select('kelurahan as name', 'id')->paginateData("all")->toArray();
		$villagesFOrmat = generalFormatArrayInput($villages['data']);

        return Inertia::render('Patient/Create', [
			'genders' => gender(),
			'villages' => $villagesFOrmat,
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        Patient::createWebapp($request);

        return redirect()->route('patients.index')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
		$villages = Village::select('kelurahan as name', 'id')->paginateData("all")->toArray();
		$villagesFOrmat = generalFormatArrayInput($villages['data']);
        return Inertia::render('Patient/Edit', [
			'data' => $patient,
			'genders' => gender(),
			'villages' => $villagesFOrmat,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $patient->updateWebapp($request);
        return redirect()->route('patients.index')->with('success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        if($patient->delete()) {
			return redirect()->route('patients.index')->with('success', 'Success');
		}
    }
}
