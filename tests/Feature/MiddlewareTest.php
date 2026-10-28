<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase; // Lo dejamos por si acaso, pero no lo usamos

class MiddlewareTest extends TestCase
{
    // NOTA: No usamos RefreshDatabase para no borrar tus datos reales

    /** 1. Un visitante (no logueado) no puede entrar a destinos */
    public function test_un_visitante_no_puede_entrar_a_destinos()
    {
        // Hacemos la petición sin estar logueados
        $response = $this->get('/destinos');
        
        // El middleware 'auth' de Breeze debe redirigir al login (302)
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /** 2. Un usuario logueado normal (role=user) NO puede entrar a destinos */
    public function test_un_usuario_normal_no_puede_entrar_a_destinos()
    {
        // Creamos el usuario manualmente para asegurar que el rol sea 'user'
        $user = User::create([
            'name' => 'Usuario Normal',
            'email' => 'normal_' . rand(1000, 9999) . '@test.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        $response = $this->actingAs($user)->get('/destinos');
        
        // El AdminMiddleware debe bloquearlo y dar un 403
        $response->assertStatus(403); 
    }

    /** 3. Un administrador SÍ puede entrar a destinos */
    public function test_un_administrador_puede_entrar_a_destinos()
    {
        // Creamos el usuario manualmente con el rol 'admin'
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin_' . rand(1000, 9999) . '@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/destinos');
        
        // Acceso exitoso (200)
        $response->assertStatus(200); 
    }

    /** 4. Un administrador puede entrar al dashboard */
    public function test_un_administrador_puede_ver_el_dashboard()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin_dash_' . rand(1000, 9999) . '@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');
        
        $response->assertStatus(200);
    }
}