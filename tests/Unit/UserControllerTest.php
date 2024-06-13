<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuariosController;
use App\Http\Repositories\Usuarios\UsuariosInterface;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UserControllerTest extends TestCase
{
    /** @test */
    public function test_crear_usuario()
    {

        $request = new Request([
            'nombre' => 'John',

            'apellidos' => 'Doe Cruz',

            'email' => 'test@test.cl'
        ]);


        $mockRepository = $this->createMock(UsuariosInterface::class);
        $mockRepository->expects($this->once())
            ->method('crearUsuario')
            ->with($request)
            ->willReturn([
                'nombre' => 'John',

                'apellidos' => 'Doe Cruz',

                'email' => 'test@test.cl'
            ]);


        $controller = new UsuariosController($mockRepository);


        $response = $controller->crearUsuario($request);


        $this->assertEquals([
            'nombre' => 'John',

            'apellidos' => 'Doe Cruz',

            'email' => 'test@test.cl'
        ], $response);
    }
}
