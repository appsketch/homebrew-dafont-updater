<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Updater\Updater\Directory;

class AlphabetTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAlphabetLength()
    {
        $this->assertCount(27, alphabet());
        $this->assertCount(26, alphabet(true, false));
    }
}
