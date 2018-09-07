<?php

namespace tests\utilities;

use app\utilities\OperacionesCurso;
use app\utilities\OperacionesCreditos;

class OperacionesCreditosTest extends \Codeception\Test\Unit
{
    
    private $usuario_de_pruebas = 209900909;
    private $mate_basica_1 = '101';

    public function testAlMenosSieteCreditos(){
        $result = OperacionesCurso::marcar_como_aprobado($this->mate_basica_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);

        $suma_creditos = OperacionesCreditos::get_total_creditos_usuario($this->usuario_de_pruebas);
        $this->assertTrue($suma_creditos >= 7);

        $result = OperacionesCurso::marcar_como_no_aprobado($this->mate_basica_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);
    }

    public function testSinModalidadesDisponibles(){
        $modalidades = OperacionesCreditos::get_modalidades_disponibles(32);
        $this->assertEmpty($modalidades);
    }

    public function testConModalidadesDisponibles(){
        $modalidades = OperacionesCreditos::get_modalidades_disponibles(36);
        $this->assertNotNull($modalidades);
    }

}