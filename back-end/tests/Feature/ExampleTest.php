<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


 

    
  /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeactivate()
    {
        $response = $this->post('http: //144.91.76.98:8081/public/api/salary/deactivate/5');

        $response->assertStatus(200);
    }
     
}
