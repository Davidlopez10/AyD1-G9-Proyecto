<?php

namespace tests\utilities;

use app\utilities\Registro;

class RegistroTest extends \Codeception\Test\Unit
{

    private $longitud_contrasena = 5;
    private $usuario_de_pruebas = 209900909;
    private $contra_de_pruebas = 123456;
    private $usuario_inexistente = -1;

    public function testRegistroDeContrasenaIncorrecta(){
        $longitud = Registro::get_longitud_contrasena($this->contra_de_pruebas);
        $this->assertTrue($longitud <= $longitud_contrasena);
    }

    public function testRegistroDeContrasenaCorrecta(){
        $longitud = Registro::get_longitud_contrasena($this->contra_de_pruebas);
        $this->assertTrue($longitud >= $longitud_contrasena);
    }

    public function testRegistroUsuarioInexistente(){
        $usuario = Registro::get_usuario_existe($this->usuario_de_pruebas);
        $this->assertTrue($usuario == 0);
    }

    public function testRegistroUsuarioExistente(){
        $usuario = Registro::get_usuario_existe($this->usuario_de_pruebas);
        $this->assertTrue($usuario > 0);
    }

}
