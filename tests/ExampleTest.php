<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use \App\Repositories\Eloquent\EmployeeRepository;

class ExampleTest extends TestCase
{

    private $employeeRepository;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testRepositories()
    {
        $this->employeeRepository = 
                $this->app->make('App\Repositories\Eloquent\EmployeeRepository');

        $count = $this->employeeRepository->count();
        $this->assertEquals(0, $count);
    }
}
