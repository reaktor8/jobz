<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource. Uses following URL-parameters when provided: field, direction
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = Input::all();
        $field = isset($input['field']) ? $input['field'] : false;
        $direction = isset($input['direction']) ? $input['direction'] : false;

        $jobs = \App\Job::getAll($field, $direction);
        
        return response()->json($jobs);
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
     * Stores array of job objects based on model provided by TE-palvelut. Note: Job is not strongly typed. Finally returns all the jobs available in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobs = json_decode($request->getContent(),true);
        
        foreach ($jobs['jobs'] as $job) {
            $existingJobs = \App\Job::checkForExisting($job);

            if(count($existingJobs) == 0) {
                $result = \App\Job::insertTeJob($job);
            }
        }
        $jobs = \App\Job::getAll();
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
