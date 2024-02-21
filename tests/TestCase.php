<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

// Models
// use Cms\Domain\Organizations\Organization;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();

        // $this->organization = Organization::factory()->create();

        // $this->property = Property::factory()->for($this->organization)->create();
    }
}
