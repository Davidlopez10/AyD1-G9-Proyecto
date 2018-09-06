<?php

namespace tests\utilities;

use app\utilities\OperacionesAsignacion;

class OperacionesAsignacionTest extends \Codeception\Test\Unit
{

    private $usuario_de_pruebas = 209900909;
    private $usuario_inexistente = -1;
    private $estadistica_1 = '732';
    private $idioma_tecnico_2 = '0008';
    private $mate_basica_2 = '103';
    private $mate_intermedia_3 = '114';
    private $deportes_1 = '039';




    public function testTratarDeVisualizarAsignacionSinPrerrequisitos(){
        $result = OperacionesAsignacion::get_cursos_con_asignacion($this->usuario_de_pruebas, array($this->mate_intermedia_3));
        $this->assertEmpty($result);
    }


    /**
    * @depends testTratarDeVisualizarAsignacionSinPrerrequisitos()
    */
    public function testTratarDeVisualizarAsignacion(){
        $result = OperacionesAsignacion::get_cursos_con_asignacion($this->usuario_de_pruebas, array($this->estadistica1, $this->$idioma_tecnico_2, $this->mate_basica_2));
        $this->assertNotEmpty($result);
    }
}
