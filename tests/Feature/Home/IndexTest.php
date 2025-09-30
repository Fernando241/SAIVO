<?php

namespace Tests\Feature\Home;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Revitaliza tu Vida con la Magia de la Medicina Indígena');
    }

    /** @test */
    public function index_displays_products_correctly(): void
    {
        // Crear 2 productos manualmente
        $product1 = Producto::create([
            'nombre' => 'Producto A',
            'slug' => 'producto-a',
            'presentacion' => 'Caja 30 unidades',
            'componentes' => 'Hierbas naturales',
            'descripcion' => 'Descripción del producto A',
            'indicaciones' => 'Para uso general',
            'contraindicaciones' => 'Ninguna',
            'stock' => 50,
            'precio_compra' => 10000,
            'precio_venta' => 15000,
            'imagen' => 'productoA.jpg',
        ]);

        $product2 = Producto::create([
            'nombre' => 'Producto B',
            'slug' => 'producto-b',
            'presentacion' => 'Frasco 100 ml',
            'componentes' => 'Extracto natural',
            'descripcion' => 'Descripción del producto B',
            'indicaciones' => 'Para uso externo',
            'contraindicaciones' => 'Evitar contacto con ojos',
            'stock' => 30,
            'precio_compra' => 12000,
            'precio_venta' => 18000,
            'imagen' => 'productoB.jpg',
        ]);

        // Hacer la petición a la página de inicio
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee($product1->nombre);
        $response->assertSee($product2->nombre);
        $response->assertSee(number_format($product1->precio_venta, 0, ',', '.'));
        $response->assertSee(number_format($product2->precio_venta, 0, ',', '.'));
    }

    /** @test */
    public function index_layout_contains_expected_classes(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('container flex flex-wrap md:flex-nowrap justify-center items-center');
        $response->assertSee('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4');
    }
}

