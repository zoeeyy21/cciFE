<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/program')->assertStatus(200);
        $this->get('/kegiatan')->assertStatus(200);
        $this->get('/galeri')->assertStatus(200);
        $this->get('/donasi')->assertStatus(200);
        $this->get('/donasi/form')->assertStatus(200);
    }
}
