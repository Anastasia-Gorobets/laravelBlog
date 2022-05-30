<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{

    public function testHomePage()
    {
        $response = $this->get('/');
        $response->assertSeeText('Blog header');
        $response->assertSeeText('First');

    }
    public function testContact()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact');
        $response->assertSeeText('Contact');

    }
}
