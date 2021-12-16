<?php
namespace Tests;
#namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Mockery as m;

class BeginGameCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        /*$this->artisan('inspire')->assertExitCode(0);

        $response = $this->get('/');

        $response->assertStatus(200);
        */


        $this->artisan('game:begin')
         ->expectsQuestion('Enter Team A players', '')
         ->expectsQuestion('Enter Team B players', '1,2,3,15')
         ->expectsOutput('Congratulations Team A!!! You\'ve won this game')
         ->doesntExpectOutput('Team A, you lose')
         ->assertExitCode(0);
    }


}
