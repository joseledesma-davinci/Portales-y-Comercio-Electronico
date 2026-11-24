<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_health_endpoint_is_available(): void
    {
        $response = $this->get('/up');

        $response->assertStatus(200);
    }
}
