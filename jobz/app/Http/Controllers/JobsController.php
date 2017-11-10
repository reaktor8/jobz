<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon ;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jobs/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobs = json_decode($request->getContent(),true);
        foreach ($jobs['jobs'] as $job) {
            $jobs = \DB::table('job')->where([
                ['job_title', 'like', $job['otsikko']],
                ['created_at', '=', Carbon::parse($job['ilmoituspaivamaara'])],
                ['company', '=', $job['tyonantajanNimi']],
            ])->get();

            if(count($jobs) == 0) {
                \DB::table('job')->insert(
                    [
                        'job_title' => $job['otsikko'], 
                        'description' => $job['kuvausteksti'], 
                        'created_at' => Carbon::parse($job['ilmoituspaivamaara']), 
                        'company' => $job['tyonantajanNimi'], 
                    ]
                );
            }
        }
        $jobs = \DB::table('job')->get();
        return response()->json($jobs);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
