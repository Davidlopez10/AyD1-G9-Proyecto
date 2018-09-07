<?php

namespace tests\utilities;

use app\utilities\OperacionesCurso;

class OperacionesAsignacionTest extends \Codeception\Test\Unit
{

    private $usuario_de_pruebas = 209900909;
    private $usuario_inexistente = -1;
    private $estadistica_1 = '732';
    private $idioma_tecnico_3 = '0009';
    public $deportes_2 = '040';
    public $deportes_1 = '039';




    public function testTratarDeVisualizarAsignacionSinPrerrequisitos(){
        $result = OperacionesCurso::get_cursos_disponibles_asignacion($this->usuario_de_pruebas, array('040'));
        $this->assertEmpty($result);
    }


    /**
    * @depends testTratarDeVisualizarAsignacionSinPrerrequisitos
    */
    public function testTratarDeVisualizarAsignacion(){
        $result = OperacionesCurso::get_cursos_disponibles_asignacion($this->usuario_de_pruebas, array('0009', '039'));
        $this->assertNotEmpty($result);
    }
}
