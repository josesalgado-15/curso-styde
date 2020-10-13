<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{

    use RefreshDatabase;

    /**
    @test
     */


    function it_shows_the_users_list()
    {

        factory(User::class)->create([
            'name' => 'Juan',
        ]);

        factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->get('/usuarios')
        ->assertStatus(200)
        ->assertSee('listado de usuarios')
        ->assertSee('Joel')
        ->assertSee('Ellie');

    }

    /**
    @test
     */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        //DB::table('users')->truncate();

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');

    }

    /**
    @test
     */
    function it_loads_the_users_details_page()
    {
        $this->get('/usuarios/5')
            ->assertStatus(200)
            ->assertSee('Mostrando detalles del usuario: 5');
    }

    /**
    @test
     */
    function it_loads_the_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear nuevo usuario');
    }

}
