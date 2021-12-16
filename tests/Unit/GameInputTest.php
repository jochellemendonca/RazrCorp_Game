<?php

namespace Tests\Unit;
use App\Console\Commands;
use PHPUnit\Framework\TestCase;

class GameInputTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $teamA_Drain_Values = "1,2,3,4";
        //$this->assertTrue(true);
        $this->assertEmpty(
            $teamA_Drain_Values,
            "data holder is not empty"
        );
    }
}
