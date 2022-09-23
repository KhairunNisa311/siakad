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
    public function test_example()
    {
        $response = $this->get('/mahasiswa/2021434574');

        $response->assertStatus(200);
        $response->assertSeeText("Jurusan");
        $response->assertSeeText("Nama");
        $response->assertSeeText("Nim");
        $response->assertSeeText("Foto");
        $response->assertSeeText("Kelas");
        $response->assertSeeText("Alamat");
        $response->assertSeeText("Tanggal Lahir");
        $response->assertSeeText("Email");

    }
}
