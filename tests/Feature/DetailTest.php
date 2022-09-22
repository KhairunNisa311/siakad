<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/mahasiswa/2021434574');

        $response->assertStatus(200);
        $response->assertSeeText("Nim: 2021434574");
        $response->assertSeeText("Nama: Milyun Ni'ma Shoumi");
        // $response->assertSeeText("Foto: ");


    }
}
