<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Updater\Updater\Alphabet;

class AlphabetTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAlphabetLength()
    {
        $this->assertCount(26, Alphabet::alphabet(false));
        $this->assertCount(27, Alphabet::alphabet());
    }
}
