<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

abstract class BaseTest extends TestCase
{
    // use migrations for tests
    use DatabaseTransactions;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return headers for authorization.
     */
    protected function authHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . config('api.bearer'),
        ];
    }
}
