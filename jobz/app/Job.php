<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon ;

class Job extends Model
{
    /**
     * Fetches all jobs (without filtering) and applies sorting rules if provided
     *
     * @param  $orderBy Indicates field used for sorting (optional)
     * @param  $direction Indicates direction of sorting (optional)
     * @return array Returns jobs
     */
    
    public static function getAll($orderBy = false, $direction = false) {
        $query = \DB::table('job');
        
        if($orderBy && $direction)
            $query->orderBy($orderBy, $direction);
        
        $jobs = $query->get();

        return $jobs;
    }

    /**
     * Checks for potentially existing job provided by TE-palvelut by comparing three fields against onces existing in database
     *
     * @param  $job Based on fields supplied by TE-palvelut (note: not strongly modeled by class)
     * @return array Returns matching existing jobs
     */
    
    public static function checkForExisting($job) {
        $jobs = \DB::table('job')->where([
            ['job_title', 'like', $job['otsikko']],
            ['created_at', '=', Carbon::parse($job['ilmoituspaivamaara'])],
            ['company', '=', $job['tyonantajanNimi']],
        ])->get();
        
        return $jobs;
    }
    
    /**
     * Insert new job based on model provided by TE-palvelut
     *
     * @param  $job Based on fields supplied by TE-palvelut (note: not strongly modeled by class)
     * @return bool Indicates whether job was saved successfully or not
     */
     
    public static function insertTeJob($job) {
        if(     !isset($job['otsikko'])
            ||  !isset($job['kuvausteksti'])
            ||  !isset($job['ilmoituspaivamaara'])
            ||  !isset($job['tyonantajanNimi'])
            )
            return false;
            
        return \DB::table('job')->insert(
            [
                'job_title' => $job['otsikko'], 
                'description' => $job['kuvausteksti'], 
                'created_at' => Carbon::parse($job['ilmoituspaivamaara']), 
                'company' => $job['tyonantajanNimi'], 
            ]
        );
    }
    //
}
