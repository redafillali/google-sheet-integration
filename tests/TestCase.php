<?php

namespace RedaElFillali\GoogleSheetIntegration\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use RedaElFillali\GoogleSheetIntegration\GoogleSheetServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            GoogleSheetServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup if needed
    }
}
