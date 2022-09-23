<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/mahasiswa/2021434574/edit');
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
