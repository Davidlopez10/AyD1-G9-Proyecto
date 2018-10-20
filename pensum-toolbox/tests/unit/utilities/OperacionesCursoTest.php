<?php

namespace tests\utilities;

use app\utilities\OperacionesCurso;

class OperacionesCursoTest extends \Codeception\Test\Unit
{

    private $usuario_de_pruebas = 209900909;
    private $usuario_inexistente = -1;
    private $mate_basica_1 = '101';
    private $mate_basica_2 = '103';
    private $mate_intermedia_1 = '107';
    private $deportes_1 = '039';
    //curso de pruebas
    private $codigoCurso = '736';
    private $codigoNull= null;
    private $nombre = 'Analisis Probabilistico';
    private $creditos = 4;
    private $creditosNegativos = -2;
    private $inicio_rama = 'N';
    private $obligatorio = 'N';
    private $creditos_necesarios = 0;
    private $area =1;
    //valores de prueba de prerrequisitos
    private $pre ='112';
    private $preNull= null;
    private $post ='118';
    public function testMarcarCursoComoNoAprobado(){
        $result = OperacionesCurso::marcar_como_no_aprobado($this->mate_intermedia_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);
        $result = OperacionesCurso::marcar_como_no_aprobado($this->mate_basica_2,$this->usuario_de_pruebas);
        $this->assertTrue($result);
        $result = OperacionesCurso::marcar_como_no_aprobado($this->mate_basica_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);
    }

    /**
     * @depends testMarcarCursoComoNoAprobado
     */
    public function testTratarDeAprobarCursoSinPrerrequisitos(){
        $result = OperacionesCurso::marcar_como_aprobado($this->mate_basica_2,$this->usuario_de_pruebas);
        $this->assertFalse($result);
    }

    /**
     * @depends testTratarDeAprobarCursoSinPrerrequisitos
     */
    public function testMarcarCursoSinPrerrequisitosAprobado(){
        $result = OperacionesCurso::marcar_como_aprobado($this->mate_basica_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);
    }

    /**
     * @depends testMarcarCursoSinPrerrequisitosAprobado
     */
    public function testMarcarCursoConPrerrequisitosAprobado(){
        $result = OperacionesCurso::marcar_como_aprobado($this->mate_basica_2,$this->usuario_de_pruebas);
        $this->assertTrue($result);
        $result = OperacionesCurso::marcar_como_no_aprobado($this->mate_basica_2,$this->usuario_de_pruebas);
        $this->assertTrue($result);
    }

    /**
     * @depends testMarcarCursoConPrerrequisitosAprobado
     */
    public function testMarcarCursoSinPrerrequisitosComoRetraUnica(){
        $result = OperacionesCurso::marcar_como_retra_unica($this->mate_basica_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);
    }

    /**
     * @depends testMarcarCursoSinPrerrequisitosComoRetraUnica
     */
    public function testTratarDeAprobarCursoConPrerrequisitoComoRetraUnica(){
        $result = OperacionesCurso::marcar_como_retra_unica($this->mate_basica_2,$this->usuario_de_pruebas);
        $this->assertFalse($result);
    }

    /**
     * @depends testMarcarCursoComoNoAprobado
     */
    public function testTratarDeMarcarCursoComoRetraUnicaSinCumplirPrerrequisitos(){
        $result = OperacionesCurso::marcar_como_retra_unica($this->mate_intermedia_1,$this->usuario_de_pruebas);
        $this->assertFalse($result);
    }

    public function testListaDeCursosDisponiblesDevuelveVacia(){
        $result = OperacionesCurso::get_cursos_disponibles($this->usuario_inexistente);
        $this->assertEmpty($result);
    }

    public function testObtenerListaDeCursosDisponibles(){
        $result = OperacionesCurso::marcar_como_aprobado($this->deportes_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);

        $result = OperacionesCurso::get_cursos_disponibles($this->usuario_de_pruebas);
        $this->assertNotEmpty($result);

        $result = OperacionesCurso::marcar_como_no_aprobado($this->deportes_1,$this->usuario_de_pruebas);
        $this->assertTrue($result);
    }
    public function testListaDeActividadesDisponiblesDevuelveActividades(){
        $result = OperacionesCurso::get_actividades_disponibles($this->usuario_de_pruebas);
        $this->assertNotEmpty($result);
    }
    public function testListaUsarioCursoActividadesExtracurriculares(){
        $result = OperacionesCurso::get_usuario_cursos_ae($this->usuario_de_pruebas);
        $this->assertNotEmpty($result);
    }
    //Pruebas de agregacion de curso
    public function testAgregarCursoConAlgunValorObligatorioNull(){
        $result = OperacionesCurso::agregar_curso($this->codigoNull,$this->nombre,$this->creditos,$this->inicio_rama,$this->obligatorio,$this->creditos_necesarios,$this->area);
        $this-> assertFalse($result);
    }
    public function testAgregarCursoConTodosLosDatosCorrectos(){
        $result = OperacionesCurso::agregar_curso($this->codigoCurso,$this->nombre,$this->creditos,$this->inicio_rama,$this->obligatorio,$this->creditos_necesarios,$this->area);
        $this-> assertTrue($result);
    }
    public function testAgregarCursoConCantidadDeCreditosNegativa(){
      $result = OperacionesCurso::creditos_otorgados_validos($this->creditosNegativos);
      $this-> assertFalse($result);
    }
    //Pruebas de prerrequisitos
    public function testAgregarPrerrequisitoSinValoresNull(){
      $result = OperacionesCurso::agregar_prerrequisto($this->pre,$this->post);
      $this-> assertTrue($result);
    }
    public function testTratarDeAgregarPrerrequisitoConAlgunValorNull(){
      $result = OperacionesCurso::agregar_prerrequisto($this->preNull,$this->post);
      $this-> assertFalse($result);
    }
}
