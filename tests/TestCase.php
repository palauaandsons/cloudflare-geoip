<?php

namespace PalauaAndSons\CloudflareGeoIp\Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    use WithWorkbench;
}
