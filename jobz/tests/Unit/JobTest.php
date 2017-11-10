<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{
    /**
     * Test fetching jobs from REST-route
     *
     * @return void
     */
    public function testFetchingJobs()
    {
        $response = $this->json('GET', '/jobs');
        $response->assertStatus(200);
    }

    /**
     * Test posting a TE-job and make sure it was saved to DB
     *
     * @return void
     */
     
    public function testJobPosting()
    {
        $response = $this->json('POST', '/jobs', [
                'jobs' => [
                    [
                        'otsikko' => 'testing title...',
                        'kuvausteksti' => 'testing description...',
                        'ilmoituspaivamaara' => "2017-10-22T21:00:00Z",
                        'tyonantajanNimi' => 'testing...'
                    ]
                ]
            ]
        );

        $this->assertDatabaseHas('job', [
            'job_title' => 'testing title...'
        ]);
        
    }
    
     /**
     * Test posting same TE-job as in previous test and make sure there is still only one record in DB. For anything else throw an exception.
     *
     * @return void
     */
    
    public function testDoubleJobPosting()
    {
        $response = $this->json('POST', '/jobs', [
                'jobs' => [
                    [
                        'otsikko' => 'testing title...',
                        'kuvausteksti' => 'testing description...',
                        'ilmoituspaivamaara' => "2017-10-22T21:00:00Z",
                        'tyonantajanNimi' => 'testing...'
                    ]
                ]
            ]
        );

        $result = \DB::table('job')->where('job_title', '=', 'testing title...')->get();
    
        if(count($result) != 1)
            throw $this->response->exception;

        $response->assertStatus(200);

    }
}
