<?php

namespace tests\utilities;

use app\utilities\Dashboard;

class DashboardTest extends \Codeception\Test\Unit
{
    
    private $usuario_de_pruebas = 209900909;

    public function testCursosDeUnAreaInexistente(){
        $cursos = Dashboard::get_cursos_por_area($this->usuario_de_pruebas, -1);
        $this->assertEmpty($cursos);
    }

    public function testCursosAreaUno(){
        $cursos = Dashboard::get_cursos_por_area($this->usuario_de_pruebas, 1);
        $this->assertNotEmpty($cursos);
    }

    public function testUsuarioSinCursos(){
        $result_arrs = Dashboard::get_cursos(-1);

        foreach($result_arrs as $result_arr){
            $this->assertEmpty($result_arr['cursos']);
        } // foreach   
    }

    public function testUsuarioConCursos(){
        $result_arrs = Dashboard::get_cursos($this->usuario_de_pruebas);

        $this->assertNotEmpty($result_arrs[0]['cursos']);
    }

    public function testEsPosibleMostrarPrerrequisitos(){
        $cursos = Dashboard::get_cursos_por_area($this->usuario_de_pruebas, 1);
        $this->assertNotNull($cursos[0]->curso0->prerrequisitos0[0]->pre0->nombre);
    }

}