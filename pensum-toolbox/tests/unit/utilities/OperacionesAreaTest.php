<?php

namespace tests\utilities;

use app\utilities\OperacionesArea;

class OperacionesAreaTest extends \Codeception\Test\Unit
{
    
    private $usuario_de_pruebas = 209900909;
    private $area_de_purebas = 4;
    private $area_inexsitente = -1;

    public function testObtenerPorcentajeDeAreaUno(){
        $result = OperacionesArea::get_porcentaje_area($this->area_de_purebas,$this->usuario_de_pruebas);
        $this->assertNotNull($result);
    }

    public function testObtenerPorcentajeDeAreaInexistente(){
        $result = OperacionesArea::get_porcentaje_area($this->area_inexsitente,$this->usuario_de_pruebas);
        $this->assertEquals($result, 0);
    }

    public function testDivisionEntreCero(){
        $result = OperacionesArea::calcular_porcentaje(0,0);
        $this->assertEquals($result, 0);
    }

    public function testDivisionEntreNegativo(){
        $result = OperacionesArea::calcular_porcentaje(-1,-1);
        $this->assertEquals($result, 0);
    }

}