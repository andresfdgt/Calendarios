<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IngredientesTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::find(1);
        $this->actingAs($user);
    }

    public function test_crear_ingrediente(){

        $response = $this->post('/ingredientes',[
            "nombre" => "test",
            "precio_base" => "12000",
            "registro_sanitario" => "test"
        ]);

        $response->assertStatus(201)
                    ->assertJson([
                        'message' => "Ingrediente registrado correctamente",
                    ]);

    }
    
    public function test_obtener_ingredientes()
    {   
        $response = $this->get('/ingredientes', ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $this->assertGreaterThanOrEqual(1, count($response["data"]));
    }

    public function test_actualizar_ingredientes()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'multipart/form-data'
        ])->put('/ingredientes/1',[
            "nombre" => "test",
            "precio_base" => "11000",
            "registro_sanitario" => "test"
        ]);

        $response->assertStatus(200)
                    ->assertJson([
                        'message' => "Ingrediente actualizado correctamente",
                    ]);

    }

    // public function test_eliminar_ingrediente()
    // {
    //     $response = $this->call('DELETE','ingredientes/1');

    //     $response->assertStatus(200)
    //                 ->assertJson([
    //                     'message' => "Ingrediente eliminado correctamente",
    //                 ]);
    // }
}
