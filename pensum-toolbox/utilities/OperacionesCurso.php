<?php

namespace app\utilities;

use Yii;
use app\models\Curso;
use app\models\UsuarioCurso;
use app\models\Prerrequisito;

class OperacionesCurso{

    public static function marcar_como_aprobado($codigo_curso, $carnet_usuario){
        try{
            if(OperacionesCurso::validar_prerrequisitos($codigo_curso, $carnet_usuario)){
                $usuario_curso_row = UsuarioCurso::find()->where('curso = :curso', [':curso' => $codigo_curso])->andWhere('usuario = :usuario', [':usuario' => $carnet_usuario])->one();
                $usuario_curso_row->estado_curso = 2;
                $usuario_curso_row->save();
                return true;
            } // if
        } catch(Exception $e){

        } // catch
        return false;
    } // marcar_como_aprobado

    public static function validar_prerrequisitos($codigo_curso, $carnet_usuario){
        $prerrequisito_rows = Prerrequisito::find()->where('post = :post', [':post' => $codigo_curso])->all();
        foreach($prerrequisito_rows as $prerrequisito_row){
            $usuario_curso_count = UsuarioCurso::find()->where('curso = :curso',[':curso' => $prerrequisito_row->pre])->andWhere('estado_curso = 2')->count();
            if($usuario_curso_count == 0){
                return false;
            } // if
            $creditos_usuario = OperacionesCreditos::get_total_creditos_usuario($carnet_usuario);
            if($prerrequisito_row->post0->creditos_necesarios > $creditos_usuario){
                return false;
            } // if
        } // foreach
        return true;
    } // validar_prerrequisitos

    public static function marcar_como_no_aprobado($codigo_curso, $carnet_usuario){
        try{
            $usuario_curso_row = UsuarioCurso::find()->where('curso = :curso', [':curso' => $codigo_curso])->andWhere('usuario = :usuario', [':usuario' => $carnet_usuario])->one();
            $usuario_curso_row->estado_curso = 1;
            $usuario_curso_row->save();
            return true;
        } catch(Exception $e){

        } // catch
        return false;
    } // marcar_como_aprobado

    public static function marcar_como_retra_unica($codigo_curso, $carnet_usuario){
        try{
            if(OperacionesCurso::validar_prerrequisitos($codigo_curso, $carnet_usuario)){
                $usuario_curso_row = UsuarioCurso::find()->where('curso = :curso', [':curso' => $codigo_curso])->andWhere('usuario = :usuario', [':usuario' => $carnet_usuario])->one();
                $usuario_curso_row->estado_curso = 3;
                $usuario_curso_row->save();
                return true;
            } // if
        } catch(Exception $e){

        } // catch
        return false;
    } // marcar_como_retra_unica

    public static function marcar_como_pre_post($codigo_curso, $carnet_usuario){
        try{
            if(OperacionesCurso::validar_prerrequisitos_pre_post($codigo_curso, $carnet_usuario)){
                $usuario_curso_row = UsuarioCurso::find()->where('curso = :curso', [':curso' => $codigo_curso])->andWhere('usuario = :usuario', [':usuario' => $carnet_usuario])->one();
                $usuario_curso_row->estado_curso = 4;
                $usuario_curso_row->save();
                return true;
            } // if
        } catch(Exception $e){

        } // catch
        return false;
    } // marcar_como_retra_unica

    public static function validar_prerrequisitos_pre_post($codigo_curso, $carnet_usuario){
        $prerrequisito_rows = Prerrequisito::find()->where('post = :post', [':post' => $codigo_curso])->all();
        foreach($prerrequisito_rows as $prerrequisito_row){
            $usuario_curso_count = UsuarioCurso::find()->where('curso = :curso',[':curso' => $prerrequisito_row->pre])->andWhere('estado_curso > 1')->count();
            if($usuario_curso_count == 0){
                return false;
            } // if
            $creditos_usuario = OperacionesCreditos::get_total_creditos_usuario($carnet_usuario);
            if($prerrequisito_row->post0->creditos_necesarios > $creditos_usuario){
                return false;
            } // if
            if($creditos_usuario < 215){
                return false;
            } // if
            return false;
        } // foreach
        return true;
    } // validar_prerrequisitos

    public static function get_cursos_disponibles($carnet_usuario){
        $total_creditos = OperacionesCreditos::get_total_creditos_usuario($carnet_usuario);

        $query_string = "SELECT C.nombre,C.codigo FROM curso as C, usuario_curso as UC
        WHERE NOT EXISTS (
          SELECT CPRE.codigo from curso as CPRE, prerrequisito as P, usuario_curso as UC1
            WHERE CPRE.codigo = P.pre
              AND C.codigo = P.post
                      AND UC1.curso = CPRE.codigo
                      AND UC1.usuario = ".$carnet_usuario."
                      AND UC1.estado_curso < 2
          )
          AND UC.curso = C.codigo
              AND UC.usuario = ".$carnet_usuario."
              AND UC.estado_curso < 2
              AND C.creditos_necesarios <= ".$total_creditos;


        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($query_string);
        $result = $command->queryAll();
        return $result;
        //SELECT CPOST.nombre FROM curso CPRE, curso CPOST, usuario_curso UC, prerrequisito P WHERE P.pre = CPRE.codigo AND P.post = CPOST.codigo AND CPRE.codigo = UC.curso AND UC.usuario = 209900909 AND UC.estado_curso = 2 AND CPOST.creditos_necesarios >= 0;
    } // get_cursos_disponibles

    /**
     * Obtiene los cursos disponibles segun cuales se aprueben
     * @param  [type] $carnet_usuario [description]
     * @param  [type] $cursos         [description]
     * @return [type]                 [description]
     */
    public static function get_cursos_disponibles_asignacion($carnet_usuario, $cursos){
        $bandera = true;
        foreach ((array)$cursos as &$curso) {
            $bandera = $bandera && OperacionesCurso::validar_prerrequisitos_asignacion($curso, $carnet_usuario);
            if(!$bandera){
                return;
            }
        }
        foreach ((array)$cursos as &$curso) {
            OperacionesCurso::marcar_como_aprobado_asignacion($curso, $carnet_usuario);
        }
        $resultado = OperacionesCurso::get_cursos_disponibles($carnet_usuario);
        foreach ((array)$cursos as &$curso) {
            OperacionesCurso::marcar_como_no_aprobado($curso, $carnet_usuario);
        }
        return $resultado;
    }

    /**
     * Validar prerequisitos para asignacion (este incluye las retras unicas)
     * @param  [type] $codigo_curso   [description]
     * @param  [type] $carnet_usuario [description]
     * @return [type]                 [description]
     */
    public static function validar_prerrequisitos_asignacion($codigo_curso, $carnet_usuario){
        $prerrequisito_rows = Prerrequisito::find()->where('post = :post', [':post' => $codigo_curso])->all();
        foreach($prerrequisito_rows as $prerrequisito_row){
            $usuario_curso_count = UsuarioCurso::find()->where('curso = :curso',[':curso' => $prerrequisito_row->pre])->andWhere('estado_curso > 1')->count();
            if($usuario_curso_count == 0){
                return false;
            } // if
            $creditos_usuario = OperacionesCreditos::get_total_creditos_usuario($carnet_usuario);
            if($prerrequisito_row->post0->creditos_necesarios > $creditos_usuario){
                return false;
            } // if
        } // foreach
        return true;
    } // validar_prerrequisitos para asignacion

    /**
     * Marcar como aprobado pero para asignacion asi que es forzado
     * @param  [type] $codigo_curso   [description]
     * @param  [type] $carnet_usuario [description]
     * @return [type]                 [description]
     */
    public static function marcar_como_aprobado_asignacion($codigo_curso, $carnet_usuario){
        try{
            if(OperacionesCurso::validar_prerrequisitos_asignacion($codigo_curso, $carnet_usuario)){
                $usuario_curso_row = UsuarioCurso::find()->where('curso = :curso', [':curso' => $codigo_curso])->andWhere('usuario = :usuario', [':usuario' => $carnet_usuario])->one();
                $usuario_curso_row->estado_curso = 2;
                $usuario_curso_row->save();
                return true;
            } // if
        } catch(Exception $e){

        } // catch
        return false;
    } // marcar_como_aprobado

    public static function get_actividades_disponibles($carnet_usuario){
      $query_string2= "SELECT * from curso where area = 8;";
      $connection = Yii::$app->getDb();
      $command = $connection->createCommand($query_string2);
      $result = $command->queryAll();
      return $result;
    }
    
    public static function get_usuario_cursos_ae($carnet_usuario){
      $query_string= "SELECT * from usuario_curso where usuario = ".$carnet_usuario." AND curso IN (SELECT codigo from curso where area=8)";
      $connection = Yii::$app->getDb();
      $command = $connection->createCommand($query_string);
      $result = $command->queryAll();
      return $result;
    }

}
