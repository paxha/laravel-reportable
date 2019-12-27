<?php

namespace Reportable\Tests;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Reportable\Tests\Models\User;

class TestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->withFactories(__DIR__.'/database/factories');

        $this->seeds();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    private function seeds()
    {
        /*Today Now*/
        factory(User::class, 3)->create([
            'created_at' => Carbon::now()
        ]);

        /*Today Now Inactive*/
        factory(User::class, 3)->create([
            'status' => 'inactive',
            'created_at' => Carbon::now()
        ]);

        /*Today Last Hour*/
        factory(User::class, 3)->create([
            'created_at' => Carbon::now()->subHour()
        ]);

        /*Yesterday*/
        factory(User::class, 3)->create([
            'created_at' => Carbon::now()->subDay()
        ]);

        /*Last Week*/
        factory(User::class, 3)->create([
            'created_at' => Carbon::now()->subWeek()
        ]);

        /*Last Month*/
        factory(User::class, 3)->create([
            'created_at' => Carbon::now()->subMonth()
        ]);

        /*Last Year*/
        factory(User::class, 3)->create([
            'created_at' => Carbon::now()->subYear()
        ]);
    }
}
