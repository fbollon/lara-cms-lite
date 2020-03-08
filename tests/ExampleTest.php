<?php

namespace Fbollon\LaraCmsLite\Tests;

use Orchestra\Testbench\TestCase;
use Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaraCmsLiteServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
